create table if not exists books(
    id_livre int auto_increment ,
    titre varchar(200),
    auteur varchar(200),
    primary key (id_livre)
    )engine=innodb;



    create table if not exists appartenir (
    book_id int,
    cat_id int,
    primary key (book_id,cat_id),
    foreign key (book_id) references books(id_livre)
    on delete cascade 
    on update cascade,
    foreign key (cat_id) references categories(id_cat)
    on delete cascade
    on update cascade
    )engine=innodb;