-- Createscript Database_jamin
-- Bedrijf Jamin - Magazijnbeheer (leveringsinformatie + allergeneninformatie)
-- **********************************************************************************
-- Version       Date:           Author:                     Description:
-- *******       **********      ****************            ******************
-- 01            25-09-2026      V                           New
-- **********************************************************************************/

-- LET OP: geen DROP DATABASE / CREATE DATABASE / USE hier, want dit script wordt
-- via file_get_contents() aangeroepen in de migration up() en php artisan migrate
-- gebruikt de database die Laravel al heeft aangemaakt (.env).

SET FOREIGN_KEY_CHECKS=0;

-- ====================================================================================
-- STAMTABELLEN (PK + extra kolommen, geen FK)
-- ====================================================================================

-- Step: 01
-- Goal: Create table Product
DROP TABLE IF EXISTS Product;

CREATE TABLE IF NOT EXISTS Product
(
    Id              TINYINT         UNSIGNED        NOT NULL    AUTO_INCREMENT
   ,Naam            VARCHAR(50)                     NOT NULL
   ,Barcode         VARCHAR(13)                     NOT NULL
   ,IsActief        BIT                             NOT NULL    DEFAULT 1
   ,Opmerkingen     VARCHAR(250)                        NULL    DEFAULT NULL
   ,DatumAangemaakt DateTime(6)                     NOT NULL
   ,DatumGewijzigd  DateTime(6)                     NOT NULL

   ,CONSTRAINT      PK_Product_Id       PRIMARY KEY CLUSTERED(Id)
   ,CONSTRAINT      UQ_Product_Barcode  UNIQUE(Barcode)
) ENGINE=InnoDB;

-- Step: 02
-- Goal: Fill table Product with data
INSERT INTO Product
(
     Naam
    ,Barcode
    ,IsActief
    ,Opmerkingen
    ,DatumAangemaakt
    ,DatumGewijzigd
)
VALUES
     ('Mintnopjes',      '8719587231278', 1, NULL, SYSDATE(6), SYSDATE(6))  -- Id 1
    ,('Schoolkrijt',     '8719587326713', 1, NULL, SYSDATE(6), SYSDATE(6))  -- Id 2
    ,('Honingdrop',      '8719587327836', 1, NULL, SYSDATE(6), SYSDATE(6))  -- Id 3
    ,('Zure Beren',      '8719587321441', 1, NULL, SYSDATE(6), SYSDATE(6))  -- Id 4
    ,('Cola Flesjes',    '8719587321237', 1, NULL, SYSDATE(6), SYSDATE(6))  -- Id 5
    ,('Turtles',         '8719587322245', 1, NULL, SYSDATE(6), SYSDATE(6))  -- Id 6
    ,('Witte Muizen',    '8719587328256', 1, NULL, SYSDATE(6), SYSDATE(6))  -- Id 7
    ,('Reuzen Slangen',  '8719587325641', 1, NULL, SYSDATE(6), SYSDATE(6))  -- Id 8
    ,('Zoute Rijen',     '8719587322739', 1, NULL, SYSDATE(6), SYSDATE(6))  -- Id 9
    ,('Winegums',        '8719587327527', 1, NULL, SYSDATE(6), SYSDATE(6))  -- Id 10
    ,('Drop Munten',     '8719587322345', 1, NULL, SYSDATE(6), SYSDATE(6))  -- Id 11
    ,('Kruis Drop',      '8719587322265', 1, NULL, SYSDATE(6), SYSDATE(6))  -- Id 12
    ,('Zoute Ruitjes',   '8719587323256', 1, NULL, SYSDATE(6), SYSDATE(6)); -- Id 13


-- Step: 03
-- Goal: Create table Allergeen
DROP TABLE IF EXISTS Allergeen;

CREATE TABLE IF NOT EXISTS Allergeen
(
    Id              TINYINT         UNSIGNED        NOT NULL    AUTO_INCREMENT
   ,Naam            VARCHAR(50)                     NOT NULL
   ,Omschrijving    VARCHAR(250)                    NOT NULL
   ,IsActief        BIT                             NOT NULL    DEFAULT 1
   ,Opmerkingen     VARCHAR(250)                        NULL    DEFAULT NULL
   ,DatumAangemaakt DateTime(6)                     NOT NULL
   ,DatumGewijzigd  DateTime(6)                     NOT NULL

   ,CONSTRAINT      PK_Allergeen_Id     PRIMARY KEY CLUSTERED(Id)
) ENGINE=InnoDB;

-- Step: 04
-- Goal: Fill table Allergeen with data
INSERT INTO Allergeen
(
     Naam
    ,Omschrijving
    ,IsActief
    ,Opmerkingen
    ,DatumAangemaakt
    ,DatumGewijzigd
)
VALUES
     ('Gluten',         'Dit product bevat gluten',           1, NULL, SYSDATE(6), SYSDATE(6))  -- Id 1
    ,('Gelatine',       'Dit product bevat gelatine',         1, NULL, SYSDATE(6), SYSDATE(6))  -- Id 2
    ,('AZO-Kleurstof',  'Dit product bevat AZO-kleurstoffen', 1, NULL, SYSDATE(6), SYSDATE(6))  -- Id 3
    ,('Lactose',        'Dit product bevat lactose',          1, NULL, SYSDATE(6), SYSDATE(6))  -- Id 4
    ,('Soja',           'Dit product bevat soja',             1, NULL, SYSDATE(6), SYSDATE(6)); -- Id 5


-- Step: 05
-- Goal: Create table Leverancier
DROP TABLE IF EXISTS Leverancier;

CREATE TABLE IF NOT EXISTS Leverancier
(
    Id                  TINYINT         UNSIGNED        NOT NULL    AUTO_INCREMENT
   ,Naam                VARCHAR(50)                     NOT NULL
   ,ContactPersoon      VARCHAR(50)                     NOT NULL
   ,LeverancierNummer   VARCHAR(15)                     NOT NULL
   ,Mobiel              VARCHAR(12)                     NOT NULL
   ,IsActief            BIT                             NOT NULL    DEFAULT 1
   ,Opmerkingen         VARCHAR(250)                        NULL    DEFAULT NULL
   ,DatumAangemaakt     DateTime(6)                     NOT NULL
   ,DatumGewijzigd      DateTime(6)                     NOT NULL

   ,CONSTRAINT      PK_Leverancier_Id               PRIMARY KEY CLUSTERED(Id)
   ,CONSTRAINT      UQ_Leverancier_LeverancierNummer UNIQUE(LeverancierNummer)
) ENGINE=InnoDB;

-- Step: 06
-- Goal: Fill table Leverancier with data
INSERT INTO Leverancier
(
     Naam
    ,ContactPersoon
    ,LeverancierNummer
    ,Mobiel
    ,IsActief
    ,Opmerkingen
    ,DatumAangemaakt
    ,DatumGewijzigd
)
VALUES
     ('Venco',        'Bert van Linge',    'L1029384719', '06-28493827', 1, NULL, SYSDATE(6), SYSDATE(6))  -- Id 1
    ,('Astra Sweets', 'Jasper del Monte',  'L1029284315', '06-39398734', 1, NULL, SYSDATE(6), SYSDATE(6))  -- Id 2
    ,('Haribo',       'Sven Stalman',      'L1029324748', '06-24383291', 1, NULL, SYSDATE(6), SYSDATE(6))  -- Id 3
    ,('Basset',       'Joyce Stelterberg', 'L1023845773', '06-48293823', 1, NULL, SYSDATE(6), SYSDATE(6))  -- Id 4
    ,('De Bron',      'Remco Veenstra',    'L1023857736', '06-34291234', 1, NULL, SYSDATE(6), SYSDATE(6)); -- Id 5


-- ====================================================================================
-- KOPPELTABELLEN (PK + één of meerdere FK + extra kolommen)
-- ====================================================================================

-- Step: 07
-- Goal: Create table Magazijn
DROP TABLE IF EXISTS Magazijn;

CREATE TABLE IF NOT EXISTS Magazijn
(
    Id                      TINYINT         UNSIGNED        NOT NULL    AUTO_INCREMENT
   ,ProductId               TINYINT         UNSIGNED        NOT NULL
   ,VerpakkingsEenheid      DECIMAL(5,2)    UNSIGNED        NOT NULL
   ,AantalAanwezig          SMALLINT        UNSIGNED            NULL    DEFAULT NULL
   ,IsActief                BIT                             NOT NULL    DEFAULT 1
   ,Opmerkingen             VARCHAR(250)                        NULL    DEFAULT NULL
   ,DatumAangemaakt         DateTime(6)                     NOT NULL
   ,DatumGewijzigd          DateTime(6)                     NOT NULL

   ,CONSTRAINT      PK_Magazijn_Id                          PRIMARY KEY CLUSTERED(Id)
   ,CONSTRAINT      FK_Magazijn_ProductId_Product_Id        FOREIGN KEY (ProductId) REFERENCES Product(Id)
) ENGINE=InnoDB;

-- Step: 08
-- Goal: Fill table Magazijn with data
-- VerpakkingsEenheid in kilogram; AantalAanwezig van Product Id 10 (Winegums) is NULL (geen voorraad, scenario_02 US1)
INSERT INTO Magazijn
(
     ProductId
    ,VerpakkingsEenheid
    ,AantalAanwezig
    ,IsActief
    ,Opmerkingen
    ,DatumAangemaakt
    ,DatumGewijzigd
)
VALUES
     (1,  5.00, 453,  1, NULL, SYSDATE(6), SYSDATE(6))
    ,(2,  2.50, 400,  1, NULL, SYSDATE(6), SYSDATE(6))
    ,(3,  5.00, 1,    1, NULL, SYSDATE(6), SYSDATE(6))
    ,(4,  1.00, 800,  1, NULL, SYSDATE(6), SYSDATE(6))
    ,(5,  3.00, 234,  1, NULL, SYSDATE(6), SYSDATE(6))
    ,(6,  2.00, 345,  1, NULL, SYSDATE(6), SYSDATE(6))
    ,(7,  1.00, 795,  1, NULL, SYSDATE(6), SYSDATE(6))
    ,(8,  10.00, 233, 1, NULL, SYSDATE(6), SYSDATE(6))
    ,(9,  2.50, 123,  1, NULL, SYSDATE(6), SYSDATE(6))
    ,(10, 3.00, NULL, 1, NULL, SYSDATE(6), SYSDATE(6))
    ,(11, 2.00, 367,  1, NULL, SYSDATE(6), SYSDATE(6))
    ,(12, 1.00, 467,  1, NULL, SYSDATE(6), SYSDATE(6))
    ,(13, 5.00, 20,   1, NULL, SYSDATE(6), SYSDATE(6));


-- Step: 09
-- Goal: Create table ProductPerAllergeen
DROP TABLE IF EXISTS ProductPerAllergeen;

CREATE TABLE IF NOT EXISTS ProductPerAllergeen
(
    Id                          TINYINT         UNSIGNED        NOT NULL    AUTO_INCREMENT
   ,ProductId                   TINYINT         UNSIGNED        NOT NULL
   ,AllergeenId                 TINYINT         UNSIGNED        NOT NULL
   ,IsActief                    BIT                             NOT NULL    DEFAULT 1
   ,Opmerkingen                 VARCHAR(250)                        NULL    DEFAULT NULL
   ,DatumAangemaakt             DateTime(6)                     NOT NULL
   ,DatumGewijzigd              DateTime(6)                     NOT NULL

   ,CONSTRAINT      PK_ProductPerAllergeen_Id                              PRIMARY KEY CLUSTERED(Id)
   ,CONSTRAINT      FK_ProductPerAllergeen_ProductId_Product_Id            FOREIGN KEY (ProductId) REFERENCES Product(Id)
   ,CONSTRAINT      FK_ProductPerAllergeen_AllergeenId_Allergeen_Id        FOREIGN KEY (AllergeenId) REFERENCES Allergeen(Id)
) ENGINE=InnoDB;

-- Step: 10
-- Goal: Fill table ProductPerAllergeen with data
-- Let op: Product Id 5 (Cola Flesjes) heeft bewust geen rij -> scenario_02 US2 (geen allergenen)
INSERT INTO ProductPerAllergeen
(
     ProductId
    ,AllergeenId
    ,IsActief
    ,Opmerkingen
    ,DatumAangemaakt
    ,DatumGewijzigd
)
VALUES
     (1,  2, 1, NULL, SYSDATE(6), SYSDATE(6))
    ,(1,  1, 1, NULL, SYSDATE(6), SYSDATE(6))
    ,(1,  3, 1, NULL, SYSDATE(6), SYSDATE(6))
    ,(3,  4, 1, NULL, SYSDATE(6), SYSDATE(6))
    ,(6,  5, 1, NULL, SYSDATE(6), SYSDATE(6))
    ,(9,  2, 1, NULL, SYSDATE(6), SYSDATE(6))
    ,(9,  5, 1, NULL, SYSDATE(6), SYSDATE(6))
    ,(10, 2, 1, NULL, SYSDATE(6), SYSDATE(6))
    ,(12, 4, 1, NULL, SYSDATE(6), SYSDATE(6))
    ,(13, 1, 1, NULL, SYSDATE(6), SYSDATE(6))
    ,(13, 4, 1, NULL, SYSDATE(6), SYSDATE(6))
    ,(13, 5, 1, NULL, SYSDATE(6), SYSDATE(6));


-- Step: 11
-- Goal: Create table ProductPerLeverancier
DROP TABLE IF EXISTS ProductPerLeverancier;

CREATE TABLE IF NOT EXISTS ProductPerLeverancier
(
    Id                              TINYINT         UNSIGNED        NOT NULL    AUTO_INCREMENT
   ,LeverancierId                   TINYINT         UNSIGNED        NOT NULL
   ,ProductId                       TINYINT         UNSIGNED        NOT NULL
   ,DatumLevering                   DATE                            NOT NULL
   ,Aantal                          SMALLINT        UNSIGNED        NOT NULL
   ,DatumEerstVolgendeLevering      DATE                                NULL    DEFAULT NULL
   ,IsActief                        BIT                             NOT NULL    DEFAULT 1
   ,Opmerkingen                     VARCHAR(250)                        NULL    DEFAULT NULL
   ,DatumAangemaakt                 DateTime(6)                     NOT NULL
   ,DatumGewijzigd                  DateTime(6)                     NOT NULL

   ,CONSTRAINT      PK_ProductPerLeverancier_Id                                    PRIMARY KEY CLUSTERED(Id)
   ,CONSTRAINT      FK_ProductPerLeverancier_LeverancierId_Leverancier_Id          FOREIGN KEY (LeverancierId) REFERENCES Leverancier(Id)
   ,CONSTRAINT      FK_ProductPerLeverancier_ProductId_Product_Id                  FOREIGN KEY (ProductId) REFERENCES Product(Id)
) ENGINE=InnoDB;

-- Step: 12
-- Goal: Fill table ProductPerLeverancier with data
-- Let op: Winegums (ProductId 10) heeft maar 1 levering en geen voorraad in Magazijn -> scenario_02 US1
-- De levering van Winegums staat op 16-04-2023 met eerstvolgende levering 30-04-2023, zodat de
-- exacte meldingstekst uit de opdracht ("... eerstvolgende levering is: 30-04-2023") klopt met de data.
INSERT INTO ProductPerLeverancier
(
     LeverancierId
    ,ProductId
    ,DatumLevering
    ,Aantal
    ,DatumEerstVolgendeLevering
    ,IsActief
    ,Opmerkingen
    ,DatumAangemaakt
    ,DatumGewijzigd
)
VALUES
     (1, 1,  '2024-10-09', 23, '2024-10-16', 1, NULL, SYSDATE(6), SYSDATE(6))
    ,(1, 1,  '2024-10-18', 21, '2024-10-25', 1, NULL, SYSDATE(6), SYSDATE(6))
    ,(1, 2,  '2024-10-09', 12, '2024-10-16', 1, NULL, SYSDATE(6), SYSDATE(6))
    ,(1, 3,  '2024-10-10', 11, '2024-10-17', 1, NULL, SYSDATE(6), SYSDATE(6))
    ,(2, 4,  '2024-10-14', 16, '2024-10-21', 1, NULL, SYSDATE(6), SYSDATE(6))
    ,(2, 4,  '2024-10-21', 23, '2024-10-28', 1, NULL, SYSDATE(6), SYSDATE(6))
    ,(2, 5,  '2024-10-14', 45, '2024-10-21', 1, NULL, SYSDATE(6), SYSDATE(6))
    ,(2, 6,  '2024-10-14', 30, '2024-10-21', 1, NULL, SYSDATE(6), SYSDATE(6))
    ,(3, 7,  '2024-10-12', 12, '2024-10-19', 1, NULL, SYSDATE(6), SYSDATE(6))
    ,(3, 7,  '2024-10-19', 23, '2024-10-26', 1, NULL, SYSDATE(6), SYSDATE(6))
    ,(3, 8,  '2024-10-10', 12, '2024-10-17', 1, NULL, SYSDATE(6), SYSDATE(6))
    ,(3, 9,  '2024-10-11', 1,  '2024-10-18', 1, NULL, SYSDATE(6), SYSDATE(6))
    ,(4, 10, '2023-04-16', 24, '2023-04-30', 1, NULL, SYSDATE(6), SYSDATE(6))
    ,(5, 11, '2024-10-10', 47, '2024-10-17', 1, NULL, SYSDATE(6), SYSDATE(6))
    ,(5, 11, '2024-10-19', 60, '2024-10-26', 1, NULL, SYSDATE(6), SYSDATE(6))
    ,(5, 12, '2024-10-11', 45, NULL,         1, NULL, SYSDATE(6), SYSDATE(6))
    ,(5, 13, '2024-10-12', 23, NULL,         1, NULL, SYSDATE(6), SYSDATE(6));

SET FOREIGN_KEY_CHECKS=1;
