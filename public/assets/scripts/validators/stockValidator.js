function validateStock(stock) {

	if (stock.amount <= 0)
		return { isValid: false, message: 'Cantidad inválida' };

	if (stock.settlement <= 0)
		return { isValid: false, message: 'Días hasta liquidación inválido' };

	return { isValid: true };
}