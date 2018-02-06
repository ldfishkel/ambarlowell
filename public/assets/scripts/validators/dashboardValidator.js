function contains(arr, findValue) {
    var i = arr.length;
     
    while (i--) 
        if (arr[i] === findValue) 
        	return true;
    
    return false;
}

function validateInvestment(data) {

	if (data.amount <= 0)
		return { isValid: false, message: 'Cantidad inválida' };

	var investors = ["Leo", "Zama", "Pela"];
	if (!contains(investors, data.investor))
		return { isValid: false, message: 'Inversor inválido' };

	return { isValid: true };
}