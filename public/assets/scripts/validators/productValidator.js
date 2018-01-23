function validateProduct(product) {

	if (product.model.length == 0)
		return { isValid: false, message: 'Nombre de modelo inválido' };

	if (product.description.length == 0)
		return { isValid: false, message: 'Descripción inválida' };

	if (product.cost <= 0)
		return { isValid: false, message: 'Costo inválido' };

	if (product.wholesale <= 0)
		return { isValid: false, message: 'Precio mayorista inválido' };

	if (product.retail <= 0)
		return { isValid: false, message: 'Precio minorista inválido' };

	return { isValid: true };
}