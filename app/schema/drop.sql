-- drop all foreign keys
DROP INDEX IF EXISTS [dbo].[FK_Loan_Book];
DROP INDEX IF EXISTS [dbo].[FK_Loan_Patron];
DROP INDEX IF EXISTS [dbo].[FK_Fine_Patron];
DROP INDEX IF EXISTS [dbo].[FK_Reservation_Book];
DROP INDEX IF EXISTS [dbo].[FK_Reservation_Patron];
DROP INDEX IF EXISTS [dbo].[FK_User_LibraryStaff];
DROP INDEX IF EXISTS [dbo].[FK_User_Patron];
DROP INDEX IF EXISTS [dbo].[FK_Mail_Patron];

-- drop all tables
DROP TABLE IF EXISTS [dbo].[Book];
DROP TABLE IF EXISTS [dbo].[Patron];
DROP TABLE IF EXISTS [dbo].[Loan];
DROP TABLE IF EXISTS [dbo].[Fine];
DROP TABLE IF EXISTS [dbo].[Reservation];
DROP TABLE IF EXISTS [dbo].[LibraryStaff];
DROP TABLE IF EXISTS [dbo].[User];
DROP TABLE IF EXISTS [dbo].[Mail];

-- drop all db function
DROP FUNCTION IF EXISTS [dbo].[CalculateTotalFine];

-- drop all db procedure
DROP PROCEDURE IF EXISTS [dbo].[AddNewBook];