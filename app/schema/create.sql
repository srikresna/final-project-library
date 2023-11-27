CREATE TABLE Book (
    BookId INT NOT NULL IDENTITY (1, 1) PRIMARY KEY,
    ISBN VARCHAR(13) NOT NULL,
    Title VARCHAR(100) NOT NULL,
    Author VARCHAR(100) NOT NULL,
    Genre VARCHAR(50) NOT NULL,
    PublicationYear DATE NOT NULL,
    QuantityAvailable INT NOT NULL,
    QuantityTotal INT NOT NULL,
);

CREATE TABLE Patron (
    PatronId INT NOT NULL IDENTITY (1, 1) PRIMARY KEY,
    FirstName VARCHAR(100) NOT NULL,
    LastName VARCHAR(100) NOT NULL,
    Email VARCHAR(100) NOT NULL,
    PhoneNumber VARCHAR(100) NOT NULL,
    Address VARCHAR(100) NOT NULL,
);

CREATE TABLE Loan (
    LoanId INT NOT NULL IDENTITY (1, 1) PRIMARY KEY,
    BookId INT NOT NULL,
    PatronId INT NOT NULL,
    LoanDate DATE NOT NULL DEFAULT GETDATE(),
    DueDate DATE NOT NULL,
    ReturnDate DATE NULL,
    FOREIGN KEY (BookId) REFERENCES Book (BookId) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (PatronId) REFERENCES Patron (PatronId) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE Fine (
    FineId INT NOT NULL IDENTITY (1, 1) PRIMARY KEY,
    PatronId INT NOT NULL,
    Amount DECIMAL(10,2) NOT NULL,
    PaymentStatus VARCHAR(10) NOT NULL,
    DueDate DATE NOT NULL,
    FOREIGN KEY (PatronId) REFERENCES Patron (PatronId) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE Reservation (
    ReservationId INT NOT NULL IDENTITY (1, 1) PRIMARY KEY,
    BookId INT NOT NULL,
    PatronId INT NOT NULL,
    ReservationDate DATE NOT NULL,
    FOREIGN KEY (BookId) REFERENCES Book (BookId) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (PatronId) REFERENCES Patron (PatronId) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE LibraryStaff (
    LibraryStaffId INT NOT NULL IDENTITY (1, 1) PRIMARY KEY,
    FirstName VARCHAR(100) NOT NULL,
    LastName VARCHAR(100) NOT NULL,
    Email VARCHAR(100) NOT NULL,
    PhoneNumber VARCHAR(100) NOT NULL,
);

CREATE TABLE [User] (
    UserId INT NOT NULL IDENTITY (1, 1) PRIMARY KEY,
    Username VARCHAR(100) NOT NULL,
    Password VARCHAR(100) NOT NULL,
    LibraryStaffId INT NULL,
    PatronId INT NULL,
    FOREIGN KEY (LibraryStaffId) REFERENCES LibraryStaff (LibraryStaffId) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (PatronId) REFERENCES Patron (PatronId) ON DELETE CASCADE ON UPDATE CASCADE
);


CREATE TABLE
    [dbo].[Book] 
(
    [BookId] INT NOT NULL IDENTITY (1, 1),
    [ISBN] VARCHAR(13) NOT NULL,
    [Title] VARCHAR(255) NOT NULL,
    [Author] VARCHAR(100) NOT NULL,
    [Genre] VARCHAR(50) NOT NULL,
    [PublicationYear] DATE NOT NULL,
    [QuantityAvailable] INT NOT NULL,
    [QuantityTotal] INT NOT NULL,
    CONSTRAINT [PK_Book] PRIMARY KEY ([BookId])
);

CREATE TABLE
    [dbo].[Patron]
(
    [PatronId] INT NOT NULL IDENTITY (1, 1),
    [FirstName] VARCHAR(100) NOT NULL,
    [LastName] VARCHAR(100) NOT NULL,
    [Email] VARCHAR(100) NOT NULL,
    [PhoneNumber] VARCHAR(100) NOT NULL,
    [Address] VARCHAR(100) NOT NULL,
    CONSTRAINT [PK_Patron] PRIMARY KEY ([PatronId])
);

CREATE TABLE
    [dbo].[Loan]
(
    [LoanId] INT NOT NULL IDENTITY (1, 1),
    [BookId] INT NOT NULL,
    [PatronId] INT NOT NULL,
    [LoanDate] DATE NOT NULL DEFAULT GETDATE(),
    [DueDate] DATE NOT NULL,
    [ReturnDate] DATE NULL,
    CONSTRAINT [PK_Loan] PRIMARY KEY ([LoanId]),
);

CREATE TABLE
    [dbo].[Fine]
(
    [FineId] INT NOT NULL IDENTITY (1, 1),
    [PatronId] INT NOT NULL,
    [Amount] DECIMAL(10,2) NOT NULL,
    [PaymentStatus] VARCHAR(10) NOT NULL,
    [DueDate] DATE NOT NULL,
    CONSTRAINT [PK_Fine] PRIMARY KEY ([FineId]),
);

CREATE TABLE
    [dbo].[Reservation]
(
    [ReservationId] INT NOT NULL IDENTITY (1, 1),
    [BookId] INT NOT NULL,
    [PatronId] INT NOT NULL,
    [ReservationDate] DATE NOT NULL,
    CONSTRAINT [PK_Reservation] PRIMARY KEY ([ReservationId]),
);

CREATE TABLE
    [dbo].[LibraryStaff]
(
    [LibraryStaffId] INT NOT NULL IDENTITY (1, 1),
    [FirstName] VARCHAR(100) NOT NULL,
    [LastName] VARCHAR(100) NOT NULL,
    [Email] VARCHAR(100) NOT NULL,
    [PhoneNumber] VARCHAR(100) NOT NULL,
    CONSTRAINT [PK_LibraryStaff] PRIMARY KEY ([LibraryStaffId])
);

CREATE TABLE
    [dbo].[User]
(
    [UserId] INT NOT NULL IDENTITY (1, 1),
    [Username] VARCHAR(100) NOT NULL,
    [Password] VARCHAR(100) NOT NULL,
    [LibraryStaffId] INT NULL,
    [PatronId] INT NULL,
    CONSTRAINT [PK_User] PRIMARY KEY ([UserId])
);


ALTER TABLE
    [dbo].[Loan] ADD CONSTRAINT [FK_Loan_Book]
    FOREIGN KEY ([BookId]) REFERENCES [dbo].[Book] ([BookId]) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE
    [dbo].[Loan] ADD CONSTRAINT [FK_Loan_Patron]
    FOREIGN KEY ([PatronId]) REFERENCES [dbo].[Patron] ([PatronId]) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE
    [dbo].[Fine] ADD CONSTRAINT [FK_Fine_Patron]
    FOREIGN KEY ([PatronId]) REFERENCES [dbo].[Patron] ([PatronId]) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE
    [dbo].[Reservation] ADD CONSTRAINT [FK_Reservation_Book]
    FOREIGN KEY ([BookId]) REFERENCES [dbo].[Book] ([BookId]) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE
    [dbo].[Reservation] ADD CONSTRAINT [FK_Reservation_Patron]
    FOREIGN KEY ([PatronId]) REFERENCES [dbo].[Patron] ([PatronId]) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE
    [dbo].[User] ADD CONSTRAINT [FK_User_LibraryStaff]
    FOREIGN KEY ([LibraryStaffId]) REFERENCES [dbo].[LibraryStaff] ([LibraryStaffId]) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE
    [dbo].[User] ADD CONSTRAINT [FK_User_Patron]
    FOREIGN KEY ([PatronId]) REFERENCES [dbo].[Patron] ([PatronId]) ON DELETE CASCADE ON UPDATE CASCADE;




