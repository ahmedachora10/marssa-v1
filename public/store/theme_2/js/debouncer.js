/*

	debounce: general function for debouncing form submissions and singelton
	other actions.

	Usage:
		debounce()  // first time, returns true
		debounce()  // subsequent times, returns false

	Practical usage:

		function submit() {
			// Validate the form THEN debounce
			return validate() && debounce();
		}

	Notes:

	If the page contains multiple singleton actions (e.g. multiple forms) then
	debounce() can be passed a `flag` (string) to distinguish between these.

	For example:

		debounce("form1")  // first time for form1, returns true
		debounce("form1")  // second time for form1, returns false

		debounce("form2")  // first time for form2, returns true
		debounce("form2")  // second time for form2, returns false

*/

var _debounceFlags = {};

function debounce(flag="default") {

	if (_debounceFlags[flag])
		return false;

	_debounceFlags[flag] = true;

	return true;
}