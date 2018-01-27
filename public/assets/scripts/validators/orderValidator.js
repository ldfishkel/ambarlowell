function validateOrder(order) {

	if (!order.client.client_id)
		if (!order.client.name)
			return { isValid: false, message: 'Not enought data for client' };
		else if (!order.client.instagram && !order.client.facebook && !order.client.phone && !order.client.email)
			return { isValid: false, message: 'Not enought data for client' };

	if (order.items.length == 0)
		return { isValid: false, message: 'Add at least one item' };

	if (order.type == "Type")
		return { isValid: false, message: 'Select a type' };


	return { isValid: true };
}

function validateStatusChange(data) {
	if (data.status != 'Cancelled' && data.status != 'Sold')
		return { isValid: false, message: 'Select different status' };

	if (data.status != 'Cancelled' && data.payment_type != 'Real' && data.payment_type != 'Virtual')
		return { isValid: false, message: 'Select Payment Type' };

	return { isValid: true };
}