
function validateCost(data) {
	if (!data.supplier.id)
		if (!data.supplier.info)
			return { isValid: false, message: 'Enter supplier info or select one in the autocomplete' };

	if (!data.concept || data.concept == "")
		return { isValid: false, message: 'Enter concept' };
	
	if (!data.amount || data.amount == "" || data.amount <= 0)
		return { isValid: false, message: 'Enter amount' };

	if (data.type == "Payment Type")
		return { isValid: false, message: 'Select a type' };

	return { isValid: true };
}