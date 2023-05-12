CREATE TABLE recipe (
    id INT(11) NOT NULL AUTO_INCREMENT,
    title VARCHAR(255) NOT NULL,
    instructions TEXT NOT NULL,
    category_id INT(11) NOT NULL,
    PRIMARY KEY (id),
    FOREIGN KEY (category_id) REFERENCES category(id)
);

CREATE TABLE ingredient (
    ingredient_id INT(11) NOT NULL AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    PRIMARY KEY (id)
);

CREATE TABLE category (
    id INT(11) NOT NULL AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL UNIQUE
    PRIMARY KEY (id),
    UNIQUE(id)
);

CREATE TABLE recipe_ingredient (
  id INT(11) NOT NULL AUTO_INCREMENT,
  recipe_id INT(11) NOT NULL,
  ingredient_id INT(11) NOT NULL,
  PRIMARY KEY (id),
  CONSTRAINT fk_recipe FOREIGN KEY (recipe_id) REFERENCES recipe(id) ON DELETE CASCADE,
  CONSTRAINT fk_ingredient FOREIGN KEY (ingredient_id) REFERENCES ingredient(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

