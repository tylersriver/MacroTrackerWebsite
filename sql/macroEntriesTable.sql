-- Created by Tyler Sriver on 2/24/2017
USE MacroTracker;

create table mealEntries
(
    Id int not null auto_increment
        primary key,
    entryTime datetime not null,
    protein int not null,
    fat int not null,
    carbs int not null,
    description text not null
);
