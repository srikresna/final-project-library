    CREATE FUNCTION [dbo].[CalculateTotalFine](@patronID INT)
    RETURNS INT
    AS
    BEGIN
        DECLARE @totalFine INT
        SELECT @totalFine = SUM(Amount) FROM [Fine] WHERE PatronID = @patronID
        RETURN @totalFine
    END;