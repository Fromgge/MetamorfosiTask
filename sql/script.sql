create table categories
(
    id         int auto_increment
        primary key,
    title      varchar(255)                         not null,
    created_at timestamp  default CURRENT_TIMESTAMP not null,
    updated_at timestamp  default CURRENT_TIMESTAMP not null on update CURRENT_TIMESTAMP,
    deleted    tinyint(1) default 0                 null
);

create table users
(
    id        int auto_increment
        primary key,
    firstname varchar(255)         not null,
    lastname  varchar(255)         not null,
    email     varchar(255)         not null,
    password  varchar(255)         not null,
    deleted   tinyint(1) default 0 null
);

create table blogs
(
    id         int auto_increment
        primary key,
    title      varchar(255)                         not null,
    content    text                                 not null,
    created_at timestamp  default CURRENT_TIMESTAMP not null,
    updated_at timestamp  default CURRENT_TIMESTAMP not null on update CURRENT_TIMESTAMP,
    author_id  int                                  not null,
    deleted    tinyint(1) default 0                 null,
    constraint blogs_ibfk_1
        foreign key (author_id) references users (id)
);

create table blog_category
(
    blog_id     int not null,
    category_id int not null,
    primary key (blog_id, category_id),
    constraint blog_category_ibfk_1
        foreign key (blog_id) references blogs (id),
    constraint blog_category_ibfk_2
        foreign key (category_id) references categories (id)
);

create index category_id
    on blog_category (category_id);

create index author_id
    on blogs (author_id);


