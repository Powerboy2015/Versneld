CREATE DATABASE windSurf;

-- DROP DATABASE windSurf;
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
    Adres varchar(128),
    isLoggedIn boolean NOT NULL,
    UserType int(1) NOT NULL,
    isVerified bool,
    PRIMARY KEY (UserId)
);

-- userType 1 = common user
-- userType 2 = instructor
-- userType 3 = admin/owner account

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


INSERT INTO USERLOG(userId,logDate,logType) VALUES (1,'2024-05-28 00:00:00.0','Login');
INSERT INTO Users(userName,email,wachtwoord,Adres,isLoggedIn,UserType,isVerified) VALUES ('Zico','empty','$2y$10$In2WpgK4CTY1QysVBm7p4epHeIOSFpLDG4s5jdm/Q30GymY7VpLnS','jema',false,1,true);

select * from users;
select * from USERLOG;

DELETE from userlog where userId < 10;