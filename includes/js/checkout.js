const settings = window.wc.wcSettings.getSetting( 'utrust_gateway_data', {} );
const label = window.wp.htmlEntities.decodeEntities( settings.title ) || window.wp.i18n.__( 'Utrust Payment', 'woocommerce-utrust' );

const Content = () => {
    return window.wp.htmlEntities.decodeEntities( settings.description || '' );
};

const Block_Gateway = {
    name: 'utrust_gateway',
    label: label,
    content: window.wp.element.createElement( Content, null ),
    edit: window.wp.element.createElement( Content, null ),
    canMakePayment: () => true,
    ariaLabel: label,
    supports: {
        features: settings.supports,
    },
};

window.wc.wcBlocksRegistry.registerPaymentMethod( Block_Gateway );
