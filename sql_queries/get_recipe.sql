DELIMITER $$

CREATE OR REPLACE FUNCTION get_recipe (recipe_id INT)
RETURNS TEXT
BEGIN
    DECLARE recipe_text TEXT;
    SELECT CONCAT(title,'#', category_id, '#', instructions, '#', GROUP_CONCAT(name SEPARATOR '|')) INTO recipe_text
    FROM recipe
    INNER JOIN recipe_ingredient ON recipe.id = recipe_ingredient.recipe_id
    INNER JOIN ingredient ON recipe_ingredient.ingredient_id = ingredient.ingredient_id
    WHERE recipe.id = recipe_id
    GROUP BY recipe.id;
    RETURN recipe_text;
END $$

DELIMITER ;
SELECT get_recipe(1);