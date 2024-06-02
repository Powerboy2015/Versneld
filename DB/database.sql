CREATE DATABASE windSurf;

-- DROP DATABASE windSurf;
USE windSurf;

CREATE TABLE Users(
    userId int NOT NULL AUTO_INCREMENT,
    userName varchar(128) NOT NULL,
    email varchar(128) NOT NULL,
    wachtwoord varchar(60) NOT NULL,
    geboorteDatum date,
    BSN int(9),
    Tel varchar(32),
    Adres varchar(128),
    isLoggedIn boolean NOT NULL default false,
    UserType INT NOT NULL default 1,
    isVerified bool NOT NULL default false,
    isBlocked boolean NOT NULL default false,
    PRIMARY KEY (UserId)
);

CREATE TABLE Reservation(
    resId int NOT NULL AUTO_INCREMENT,
    userId int NOT NULL,
    instructorId int NOT NULL,
    startDatum datetime NOT NULL,
    eindDatum datetime NOT NULL,
    pakketType int(1) NOT NULL,
    locatie varchar(128) NOT NULL,
    aantPers int(3) NOT NULL,
    resStatus int(1) NOT NULL,
    PRIMARY KEY (resId),
    FOREIGN KEY(userId) REFERENCES Users(userId),
    FOREIGN KEY(instructorId) REFERENCES Users(userId)
);

CREATE TABLE USERLOG(
    logId int unsigned NOT NULL AUTO_INCREMENT,
    userId int unsigned NOT NULL,
    logDate datetime(6) NOT NULL,
    logType varchar(128) NOT NULL,
    PRIMARY KEY (logId),
    FOREIGN KEY (userId) REFERENCES Users(userId)
);
INSERT INTO Users(userName,email,wachtwoord,Adres,isLoggedIn,isVerified) VALUES ('Zico','empty','$2y$10$In2WpgK4CTY1QysVBm7p4epHeIOSFpLDG4s5jdm/Q30GymY7VpLnS','jema',false,true);
INSERT INTO Users(userName,email,wachtwoord,UserType,isVerified) VALUES ('Admin','admin@gmail.com','$2y$10$In2WpgK4CTY1QysVBm7p4epHeIOSFpLDG4s5jdm/Q30GymY7VpLnS',3,true);
INSERT INTO Users(userName,email,wachtwoord) VALUES('piet','piet@gmail.com','$2y$10$h1.pz6zRQDmauuQIgGabiuIbg4vwuOuSTNTA/gx.4ZGlOTunPTZqe'),
												   ('gerard','gerard@gmail.com','$2y$10$h1.pz6zRQDmauuQIgGabiuIbg4vwuOuSTNTA/gx.4ZGlOTunPTZqe'),
                                                   ('johan','johan@gmail.com','$2y$10$h1.pz6zRQDmauuQIgGabiuIbg4vwuOuSTNTA/gx.4ZGlOTunPTZqe'),
                                                   ('jeroen','jeroen@gmail.com','$2y$10$h1.pz6zRQDmauuQIgGabiuIbg4vwuOuSTNTA/gx.4ZGlOTunPTZqe');

SELECT wachtwoord FROM users WHERE wachtwoord = '$2y$10$h1.pz6zRQDmauuQIgGabiuIbg4vwuOuSTNTA/gx.4ZGlOTunPTZqe';

SELECT * FROM Users;
SELECT * FROM USERLOG;
SELECT * FROM reservation;

update users
set Tel = "21890808"
where userId = 3;

update users
set userType = 3	
where userId= 3;

DELETE FROM Users WHERE userId = 2;