function formatMoney(amount, options={}) {

	// Note:
	//
	// The dictionaries _ndecimals and _formats are replicas of those in the
	// module money.py. Please keep both copies consistent.

	const _ndecimals = {
		"USD": 2,
		"JOD": 2,
		"AED": 2,
		"BHD": 3,
		"DZD": 2,
		"EGP": 2,
		"IQD": 3,
		"KWD": 3,
		"LBP": 2,
		"LYD": 3,
		"MAD": 2,
		"QAR": 2,
		"SAR": 2,
		"SYP": 2,
		"TND": 3,
		"TRY": 2,
		"YDD": 3,
		"OMR": 3,
		"ILS": 2,
	};

	const _formats = {
		"USD": "%(sign)s $%(amount)s",
		"TRY": "%(sign)s ₺%(amount)s",
		"JOD": "%(sign)s %(amount)s JD",
		"AED": "%(sign)s %(amount)s AED",
		"BHD": "%(sign)s %(amount)s BD",
		"DZD": "%(sign)s %(amount)s DA",
		"EGP": "%(sign)s %(amount)s EGP",
		"IQD": "%(sign)s %(amount)s IQD",
		"KWD": "%(sign)s %(amount)s KD",
		"LBP": "%(sign)s %(amount)s LL",
		"LYD": "%(sign)s %(amount)s LD",
		"MAD": "%(sign)s %(amount)s DH",
		"QAR": "%(sign)s %(amount)s QR",
		"SAR": "%(sign)s %(amount)s SAR",
		"SYP": "%(sign)s %(amount)s LS",
		"TND": "%(sign)s %(amount)s DT",
		"YDD": "%(sign)s %(amount)s YDD",
		"OMR": "%(sign)s %(amount)s OMR",
		"ILS": "%(sign)s ₪%(amount)s",
	}

	if (typeof STORE_CURRENCY === "undefined") {
		console.error("STORE_CURRENCY is not defined");
	}

	const {
		currency = STORE_CURRENCY,
	} = options;

	const format = _formats[currency];
	const ndecimals = _ndecimals[currency];

	const positive = amount >= 0;
	const sign = positive ? "" : "-";
	const amount_abs = Math.abs(Number(amount));

	const amount_s = amount_abs.toFixed(ndecimals);

	return format
		.replace("%(sign)s", sign)
		.replace("%(amount)s", amount_s)
		.trim();

}
