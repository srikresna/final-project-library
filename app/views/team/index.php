<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style>
    body {
      font-family: 'Arial', sans-serif;
      margin: 0;
      padding: 0;
      background-color: #f4f4f4;
      color: #333;
      text-align: center;
    }

    #team-introduction {
      background-color: #3498db;
      padding: 50px 0;
      color: #fff;
    }

    .team-member {
      width: 200px; /* Set a fixed width for consistent size */
      position: relative;
      display: inline-block;
      margin: 20px;
      overflow: hidden;
      border-radius: 15px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      transition: transform 0.3s ease-in-out;
    }

    .team-member img {
      display: block;
      width: 100%;
      height: auto;
      border-top-left-radius: 15px;
      border-top-right-radius: 15px;
    }

    .team-member .member-info {
      padding: 20px;
      background-color: #fff;
      box-sizing: border-box;
    }

    .team-member p {
      margin: 10px 0;
      font-size: 16px;
      margin-bottom: 0;
    }

    .team-member:hover {
      transform: translateY(-10px);
    }

    #main-content {
      padding: 50px;
    }

    h3 {
      color: #333;
    }

    p {
      font-size: 18px;
      line-height: 1.6;
      color: #555;
    }
  </style>
  <title>Team Introduction</title>
</head>
<body>

  <section id="team-introduction">
    <h2>Meet Our Team</h2>
    <div class="team-member">
      <img src="<?=BASE_URL; ?>/img/female1.png" alt="Azahra Salsabila">
      <div class="member-info">
        <p style="font-weight: bold;">Azahra Salsabila</p>
        <p>Number 05</p>
      </div>
    </div>
    <div class="team-member">
      <img src="<?=BASE_URL; ?>/img/female2.png" alt="Lenka Melinda Florienka">
      <div class="member-info">
        <p style="font-weight: bold;">Lenka Melinda</p>
        <p>Number 12</p>
      </div>
    </div>
    <div class="team-member">
      <img src="<?=BASE_URL; ?>/img/male1.png" alt="Sri Kresna Maha Dewa">
      <div class="member-info">
        <p style="font-weight: bold;">Sri Kresna</p>
        <p>Number 23</p>
      </div>
    </div>
  </section>

  <section id="main-content">
    <h3>Welcome to Our Library</h3>
    <p>Your modern hub for knowledge and exploration. Immerse yourself in a diverse collection of books, discover new titles, and elevate your learning experience. Reserve your favorite books online and pick them up at your convenience.</p>
    
  </section>

  <script>
    // Fade-in animation when the page loads
    document.addEventListener("DOMContentLoaded", function () {
      const fadeInElements = document.querySelectorAll(".team-member, #main-content");

      fadeInElements.forEach((element) => {
        element.style.opacity = 0;
        element.style.transition = "opacity 1s ease-in-out";
      });

      let delay = 500;
      fadeInElements.forEach((element) => {
        setTimeout(() => {
          element.style.opacity = 1;
        }, delay);
        delay += 500;
      });
    });
  </script>

</body>
</html>
