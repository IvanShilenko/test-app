DELIMITER //
CREATE PROCEDURE add_order (IN user varchar(16),IN order_name varchar(16),IN price decimal(10,2),IN state INT)
BEGIN
    INSERT INTO orders SET user=user,order_name=order_name,price=price,buy_date=NOW(),create_date=NOW(),state=state;
END 

DROP PROCEDURE add_order;
--------------------------------------------------------------
DELIMITER //
CREATE PROCEDURE delete_order (IN _id INT)
BEGIN
    DELETE FROM orders WHERE id=_id;
END 

DROP PROCEDURE delete_order;
--------------------------------------------------------------
DELIMITER //
CREATE PROCEDURE payment_order (IN _id INT)
BEGIN
    UPDATE orders SET state=2 WHERE id=_id;
END 

DROP PROCEDURE payment_order;