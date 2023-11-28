
INSERT INTO [dbo].[Book] ([ISBN], [Title], [Author], [Genre], [PublicationYear], [QuantityAvailable], [QuantityTotal]) 
VALUES ('9780000000000', 'The Hobbit', 'J. R. R. Tolkien', 'Fantasy', '1937-09-21', 3, 5),
            ('9780000000001', 'The Fellowship of the Ring', 'J. R. R. Tolkien', 'Fantasy', '1954-07-29', 3, 5),
            ('9780000000002', 'The Two Towers', 'J. R. R. Tolkien', 'Fantasy', '1954-11-11', 3, 5),
            ('9780000000003', 'The Return of the King', 'J. R. R. Tolkien', 'Fantasy', '1955-10-20', 1, 5),
            ('9780000000004', 'The Silmarillion', 'J. R. R. Tolkien', 'Fantasy', '1977-09-15', 4, 5),
            ('9780000000005', 'The Children of Húrin', 'J. R. R. Tolkien', 'Fantasy', '2007-04-17', 2, 5),
            ('9780000000006', 'The Fall of Gondolin', 'J. R. R. Tolkien', 'Fantasy', '2018-08-30', 5, 5),
            ('9780000000007', 'The Adventures of Tom Bombadil', 'J. R. R. Tolkien', 'Fantasy', '1962-11-15', 5, 5),
            ('9780000000008', 'The Road Goes Ever On', 'J. R. R. Tolkien', 'Fantasy', '1967-12-31', 1, 5),
            ('9780000000009', 'Unfinished Tales', 'J. R. R. Tolkien', 'Fantasy', '1980-10-02', 5, 5),
            ('9780000000010', 'The History of Middle-earth', 'J. R. R. Tolkien', 'Fantasy', '1983-06-01', 5, 5),
            ('9780000000011', 'The History of The Hobbit', 'J. R. R. Tolkien', 'Fantasy', '2007-09-27', 5, 5),
            ('9780000000012', 'The Father Christmas Letters', 'J. R. R. Tolkien', 'Fantasy', '1976-11-02', 3, 3);


INSERT INTO [dbo].[Patron] ([FirstName], [LastName], [Email], [PhoneNumber], [Address])
VALUES ('Gareng', 'Pandawa', 'garengganteng@mail.com', '081234567890', 'Jl. Semar No. 1'),
         ('Petruk', 'Pandawa', 'petruklanang@mail.com', '081234567891', 'Jl. Semar No. 2'),
         ('Bagong', 'Pandawa', 'bagonglemu@mail.com', '081234567892', 'Jl. Semar No. 3'),
         ('Semar', 'Pandawa', 'semarkentut@mail.com', '081234567893', 'Jl. Semar No. 4');

INSERT INTO [dbo].[Loan] ([BookId], [PatronId], [LoanDate], [DueDate], [ReturnDate])
VALUES (1, 1, '2023-01-01', '2023-01-08', '2023-01-02'),
         (2, 2, '2023-02-01', '2023-02-08', '2023-01-03'),
         (3, 3, '2023-03-01', '2023-03-08', '2023-01-04'),
         (4, 4, '2024-04-01', '2023-04-08', '2023-01-05');

INSERT INTO [dbo].[Fine] ([PatronId], [Amount], [PaymentStatus], [DueDate])
VALUES (1, 10000, 'Paid', '2023-01-08'),
         (2, 20000, 'Paid', '2023-02-08'),
         (3, 30000, 'Paid', '2023-03-08'),
         (4, 40000, 'Paid', '2023-04-08');

INSERT INTO [dbo].[Reservation] ([BookId], [PatronId], [ReservationDate])
VALUES (5, 1, '2023-11-01'),
         (6, 2, '2023-11-02'),
         (7, 3, '2023-11-03'),
         (8, 4, '2023-11-04');

INSERT INTO [dbo].[LibraryStaff] ([FirstName], [LastName], [Email], [PhoneNumber])
VALUES ('Bambang', 'Sutopo', 'sutopobambang@mail.com', '081234567894'),
        ('Nurhadi', 'Sudjatmiko', 'jadmikoadi@mail.com', '081234567895');

-- INSERT INTO [dbo].[User] ([Username], [Password], [Role])
-- VALUES ('bambang', 'admin', 'LibraryStaff'),
--          ('nurhadi', 'admin', 'LibraryStaff'),
--          ('gareng', 'gareng', 'Patron'),
--          ('petruk', 'petruk', 'Patron'),
--          ('bagong', 'bagong', 'Patron'),
--          ('semar', 'semar', 'Patron');

INSERT INTO [dbo].[User] ([Username], [Password], [Role], [LibraryStaffId], [PatronId])
VALUES ('bambang', 'admin', 'LibraryStaff', 1, NULL),
         ('nurhadi', 'admin', 'LibraryStaff', 2, NULL),
         ('gareng', 'gareng', 'Patron', NULL, 1),
         ('petruk', 'petruk', 'Patron', NULL, 2),
         ('bagong', 'bagong', 'Patron', NULL, 3),
         ('semar', 'semar', 'Patron', NULL, 4);
