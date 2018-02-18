function validateProduct(product) {

	if (product.type != 'PF' && product.type != 'PI' && product.type != 'AC' && product.type != 'AB')
		return { isValid: false, message: 'Seleccionar tipo válido' };

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

function validateTag(tag) {

	if (tag.name.length == 0)
		return { isValid: false, message: 'Nombre de Tag inválido' };

	return { isValid: true };
}