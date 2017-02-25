-- Created by Tyler Sriver on 2/24/2017
USE MacroTracker;

CREATE TABLE mealEntries (
    Id int AUTO_INCREMENT NOT NULL PRIMARY KEY,
    entryTime DATETIME NOT NULL,
    protein int NOT NULL,
    fat int NOT NULL,
    carbs int NOT NULL
);
