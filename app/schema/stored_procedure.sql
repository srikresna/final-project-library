CREATE PROCEDURE AddNewBook
    @isbn nvarchar(50),
    @title nvarchar(255),
    @author nvarchar(255),
    @genre nvarchar(50),
    @pubyear date,
    @qtyAvail int,
    @qtyTotal int
AS
BEGIN
    INSERT INTO Book (ISBN, Title, Author, Genre, PublicationYear, QuantityAvailable, QuantityTotal)
    VALUES (@isbn, @title, @author, @genre, @pubyear, @qtyAvail, @qtyTotal);
END;