DELIMITER //
CREATE TRIGGER tr_updateStockCompra AFTER INSERT ON purchase_details
FOR EACH ROW BEGIN
UPDATE products SET stock = stock + NEW.cantidad
WHERE products.id = NEW.product_id;
END;
//
DELIMITER ;

DELIMITER //
CREATE TRIGGER tr_updateStockCompraAnular AFTER UPDATE ON purchase_details
FOR EACH ROW BEGIN
UPDATE products p
 JOIN purchase_details di
 ON di.product_id = p.id
 SET p.stock = p.stock - di.cantidad;
END;
//
DELIMITER ;

DELIMITER //
CREATE TRIGGER tr_updateStockVentaAnular AFTER UPDATE ON sale_details
FOR EACH ROW BEGIN
UPDATE products p
 JOIN sale_details sa
 ON sa.product_id = p.id
 SET p.stock = p.stock + sa.cantidad;
END;
//
DELIMITER ;
DELIMITER //
CREATE TRIGGER tr_updateStockVenta AFTER INSERT ON sale_details
FOR EACH ROW BEGIN
UPDATE products SET stock = stock - NEW.cantidad
WHERE products.id = NEW.product_id;
END;
//
DELIMITER ;