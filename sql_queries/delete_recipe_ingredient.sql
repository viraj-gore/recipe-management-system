DELIMITER //

CREATE PROCEDURE delete_recipe_ingredient(IN recipe_id INT)
BEGIN
    DELETE FROM recipe_ingredient WHERE recipe_id = recipe_id;
END//

DELIMITER ;
