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

CREATE PROCEDURE AddNewLoan
    @bookId int,
    @patronId int,
    @loanDate date,
    @dueDate date
AS
BEGIN
    BEGIN TRANSACTION;
    BEGIN TRY
        -- Update the book quantity
        DECLARE @currentQuantity int;
        SELECT @currentQuantity = QuantityAvailable FROM Book WHERE BookId = @bookId;
        IF @currentQuantity > 0
        BEGIN
            UPDATE Book SET QuantityAvailable = @currentQuantity - 1 WHERE BookId = @bookId;

            -- Add the loan record
            INSERT INTO Loan (BookId, PatronId, LoanDate, DueDate)
            VALUES (@bookId, @patronId, @loanDate, @dueDate);
        END
        COMMIT;
    END TRY
    BEGIN CATCH
        ROLLBACK;
        THROW;
    END CATCH
END;
