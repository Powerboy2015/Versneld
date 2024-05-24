CREATE DATABASE windSurf;

USE windSurf;



CREATE TABLE Users(
    userId int NOT NULL AUTO_INCREMENT,
    userName varchar(128) NOT NULL,
    email varchar(128) NOT NULL,
    wachtwoord varchar(60) NOT NULL,
    firstName varchar(128),
    lastName varchar(128),
    geboorteDatum date,
    BSN int(9),
    Tel varchar(32),
    Adres varchar(128) NOT NULL,
    isLoggedIn boolean NOT NULL,
    PRIMARY KEY (UserId)
);

CREATE TABLE Reservation(
    resId int NOT NULL AUTO_INCREMENT,
    userId int NOT NULL,
    startDatum datetime NOT NULL,
    eindDatum datetime NOT NULL,
    pakketType int(1) NOT NULL,
    locatie varchar(128) NOT NULL,
    aantPers int(3) NOT NULL,
    PRIMARY KEY (resId),
    FOREIGN KEY(userId) REFERENCES Users(userId)
);

CREATE TABLE USERLOG(
    logId int unsigned NOT NULL AUTO_INCREMENT,
    userId int unsigned NOT NULL,
    logDate datetime(6) NOT NULL,
    logType varchar(128) NOT NULL,
    PRIMARY KEY (logId),
    FOREIGN KEY (userId) REFERENCES Users(userId)
);
INSERT INTO Users(userName,email,wachtwoord,Adres,isLoggedIn) VALUES ("Zico","hi","yes","yes",true);

SELECT * FROM Users;

