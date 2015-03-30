create table polls_ireland (
    id int not null auto_increment primary key,
    date DATE,
    source varchar(25),
    ff int,
    fg int,
    lab int,
    sf int,
    others int,
    pd int
);
