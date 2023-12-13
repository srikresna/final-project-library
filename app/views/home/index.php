<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library Homepage</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8f8f8;
            color: #333;
        }

        header {
            background-color: #4285f4;
            padding: 20px;
            text-align: center;
            color: #fff;
        }

        header h1 {
            color: #fff;
        }

        .info-text {
            max-width: 800px;
            margin: 20px auto;
            line-height: 1.6;
            text-align: justify;
        }

        .features {
            display: flex;
            justify-content: space-around;
            flex-wrap: wrap;
            margin: 20px auto;
        }

        .feature {
            width: 30%;
            padding: 20px;
            margin: 10px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease-in-out;
        }

        .feature:hover {
            transform: scale(1.05);
        }

        footer {
            background-color: #333;
            color: #fff;
            text-align: center;
            padding: 10px;
            position: fixed;
            bottom: 0;
            width: 100%;
        }
    </style>
</head>
<body>
    <header>
        <h1>Welcome to Our Library</h1>
        <p>Explore, Discover, and Learn</p>
    </header>

    <section>
        <div class="info-text">
            <p>Welcome to the Library, your modern hub for knowledge and exploration. Immerse yourself in a diverse collection of books, discover new titles, and elevate your learning experience. Reserve your favorite books online and pick them up at your convenience.</p>
            <p>Our flexible loan services empower you to borrow books and materials, ensuring you have access to the resources you need. Stay informed about the latest library information, events, and services.</p>
        </div>

        <div class="features">
            <div class="feature" data-aos="fade-up">
                <h2>Book Reservation</h2>
                <p>Reserve your books online and pick them up at your convenience.</p>
            </div>

            <div class="feature" data-aos="fade-up" data-aos-delay="100">
                <h2>Loan Services</h2>
                <p>Borrow books and other materials for a specified period.</p>
            </div>

            <div class="feature" data-aos="fade-up" data-aos-delay="200">
                <h2>Library Information</h2>
                <p>Get details about our library, services, and events.</p>
            </div>
        </div>
    </section>

    <footer>
        <p>&copy; 2023 Library Name. All rights reserved.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            AOS.init();
        });
    </script>
</body>
</html>
