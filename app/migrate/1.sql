create table users (
    id BIGINT UNSIGNED PRIMARY KEY AUTO_INCREMENT NOT NULL,
    type TINYINT NOT NULL,
    company_id BIGINT UNSIGNED NOT NULL,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    password VARCHAR(100) NOT NULL,
    create_at VARCHAR(20),
    update_at VARCHAR(20),
    FOREIGN KEY (company_id) REFERENCES companies(id)
);

create table counts (
    id BIGINT UNSIGNED PRIMARY KEY AUTO_INCREMENT NOT NULL,
    company_id BIGINT UNSIGNED NOT NULL,
    provider VARCHAR(100) NOT NULL,
    n_document INT UNSIGNED NOT NULL,
    value DECIMAL(10,2) NOT NULL,
    obs VARCHAR(255),
    type TINYINT UNSIGNED NOT NULL,
    expiration_date VARCHAR(10),
    create_at VARCHAR(20),
    update_at VARCHAR(20),
    FOREIGN KEY (company_id) REFERENCES companies(id)
);

CREATE TABLE companies (
    id BIGINT UNSIGNED PRIMARY KEY AUTO_INCREMENT NOT NULL,
    cnpj VARCHAR(20) NOT NULL,
    social_name VARCHAR(155) NOT NULL,
    company_name VARCHAR(155) NOT NULL,
    company_email VARCHAR(100) NOT NULL,
    address_id BIGINT UNSIGNED,
    fone VARCHAR(20),
    create_at VARCHAR(20),
    update_at VARCHAR(20),
    FOREIGN KEY (address_id) REFERENCES address(id)
)

CREATE TABLE address (
    id BIGINT UNSIGNED PRIMARY KEY AUTO_INCREMENT NOT NULL,
    public_place VARCHAR(200),
    number VARCHAR(20),
    neighborhood VARCHAR(20),
    city VARCHAR(40),
    state VARCHAR(2),
    country VARCHAR(50),
    zip_code varchar(20)
)

CREATE TABLE modules (
    id INT UNSIGNED PRIMARY KEY AUTO_INCREMENT NOT NULL,
    group VARCHAR(20),
    subgroup VARCHAR(40),
    link VARCHAR(20)
)

CREATE TABLE user_modules (
    id BIGINT UNSIGNED PRIMARY KEY AUTO_INCREMENT NOT NULL,
    company_id BIGINT UNSIGNED NOT NULL,
    module_id INT UNSIGNED NOT NULL
)
