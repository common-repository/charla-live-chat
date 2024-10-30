
window.addEventListener('load', () => {

	if (!charla_params.property_key) return;

	const widgetElement = document.createElement('charla-widget');
	widgetElement.setAttribute("p", charla_params.property_key);
	widgetElement.setAttribute("wc_customer", JSON.stringify(charla_params.customer) );
	widgetElement.setAttribute("wc_cart", JSON.stringify(charla_params.cart) ) ;

	document.body.appendChild(widgetElement) ;

	const widgetCode = document.createElement('script');
	widgetCode.src = 'https://app.getcharla.com/widget/widget.js';
	document.body.appendChild(widgetCode);
})

