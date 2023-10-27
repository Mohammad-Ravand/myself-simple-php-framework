create table if not exists cafe
(
    id    int auto_increment
        constraint `PRIMARY`
        primary key,
    title varchar(60) null
);

create table if not exists hotel
(
    id    int auto_increment
        constraint `PRIMARY`
        primary key,
    title varchar(60) not null
);

create table if not exists hotel_translate
(
    id          int auto_increment
        constraint `PRIMARY`
        primary key,
    title       varchar(60) not null,
    hotel_id    int         null,
    language_id int         null,
    constraint hotel_id
        foreign key (hotel_id) references hotel (id)
);

create table if not exists language
(
    id   int auto_increment
        constraint `PRIMARY`
        primary key,
    name varchar(60) not null
);

create table if not exists cafe_translate
(
    id          int auto_increment
        constraint `PRIMARY`
        primary key,
    title       varchar(60) not null,
    cafe_id     int         null,
    language_id int         null,
    constraint cafe_id
        foreign key (cafe_id) references cafe (id),
    constraint language_id
        foreign key (language_id) references language (id)
);

