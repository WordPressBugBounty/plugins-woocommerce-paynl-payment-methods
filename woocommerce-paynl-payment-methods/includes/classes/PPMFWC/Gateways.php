<?php

/**
 * PPMFWC_Gateways
 *
 * @phpcs:disable PSR1.Classes.ClassDeclaration.MissingNamespace
 * @phpcs:disable Squiz.Classes.ValidClassName.NotCamelCaps
 * @phpcs:disable PSR1.Methods.CamelCapsMethodName
 * @phpcs:disable PSR12.Properties.ConstantVisibility
 */
class PPMFWC_Gateways
{
    const STATUS_PENDING = 'PENDING';
    const STATUS_CANCELED = 'CANCELED';
    const STATUS_DENIED = 'DENIED';
    const STATUS_SUCCESS = 'SUCCESS';
    const STATUS_AUTHORIZE = 'AUTHORIZE';
    const STATUS_VERIFY = 'VERIFY';
    const STATUS_REFUND = 'REFUND';
    const STATUS_REFUND_PARTIALLY = 'PARTREF';
    const STATUS_CAPTURE = 'CAPTURE';
    const STATUS_CHARGEBACK = 'CHARGEBACK';
    const STATUS_PINREFUND = 'PINREFUND';

    const ACTION_NEWPPT = 'new_ppt';
    const ACTION_PENDING = 'pending';
    const ACTION_CANCEL = 'cancel';
    const ACTION_VERIFY = 'verify';
    const ACTION_REFUND = 'refund:received';
    const ACTION_CAPTURE = 'capture';
    const ACTION_CHARGEBACK = 'chargeback:chargeback';
    const ACTION_PINREFUND = 'pinrefund';

    const TAB_ID = 'pay_settings';

    /**
     * @param string $default Adds text 'default' for the selected option
     * @param array $excludeStates List of statusus that should not return
     * @return array
     * @phpcs:disable Squiz.Commenting.FunctionComment.TypeHintMissing
     */
    private static function getAvailableWoocomStatus($default, $excludeStates = array())
    {
        $txt = esc_html(' (' . __('default', PPMFWC_WOOCOMMERCE_TEXTDOMAIN) . ')');

        if ($default == 'off') {
            $arrStates['off'] = 'off';
        }
        $arrStates['processing'] = PPMFWC_Gateway_Abstract::STATUS_PROCESSING;
        $arrStates['pending'] = PPMFWC_Gateway_Abstract::STATUS_PENDING;
        $arrStates['cancel'] = PPMFWC_Gateway_Abstract::STATUS_CANCELLED;
        $arrStates['refunded'] = PPMFWC_Gateway_Abstract::STATUS_REFUNDED;
        $arrStates['failed'] = PPMFWC_Gateway_Abstract::STATUS_FAILED;
        $arrStates['onhold'] = PPMFWC_Gateway_Abstract::STATUS_ON_HOLD;
        $arrStates['completed'] = PPMFWC_Gateway_Abstract::STATUS_COMPLETED;

        $availableStatuses = array();
        foreach ($arrStates as $state) {
            if (!in_array($state, $excludeStates)) {
                $availableStatuses[$state] = ucfirst(wc_get_order_status_name($state)) . ($state == $default ? $txt : '');
            }
        }

        return $availableStatuses;
    }

    private static $arrGateways = array(
        'PPMFWC_Gateway_Alipay',
        'PPMFWC_Gateway_AlipayPlus',
        'PPMFWC_Gateway_Alma',
        'PPMFWC_Gateway_Amazonpay',
        'PPMFWC_Gateway_Amex',
        'PPMFWC_Gateway_Applepay',
        'PPMFWC_Gateway_Afterpay',
        'PPMFWC_Gateway_AfterpayInternational',
        'PPMFWC_Gateway_BataviastadCadeaukaart',
        'PPMFWC_Gateway_Bbqcadeaukaart',
        'PPMFWC_Gateway_Beautyandmorecadeaukaart',
        'PPMFWC_Gateway_Beautycadeau',
        'PPMFWC_Gateway_Biercheque',
        'PPMFWC_Gateway_Biller',
        'PPMFWC_Gateway_Billink',
        'PPMFWC_Gateway_Bioscoopbon',
        'PPMFWC_Gateway_Bizum',
        'PPMFWC_Gateway_Blik',
        'PPMFWC_Gateway_BloemenCadeaukaart',
        'PPMFWC_Gateway_Boekenbon',
        'PPMFWC_Gateway_Brite',
        'PPMFWC_Gateway_Cartasi',
        'PPMFWC_Gateway_Capayable',
        'PPMFWC_Gateway_CapayableGespreid',
        'PPMFWC_Gateway_Cartebleue',
        'PPMFWC_Gateway_Clickandbuy',
        'PPMFWC_Gateway_CreditClick',
        'PPMFWC_Gateway_Cashly',
        'PPMFWC_Gateway_Cult',
        'PPMFWC_Gateway_Good4fun',
        'PPMFWC_Gateway_HorsesandGifts',
        'PPMFWC_Gateway_Huisdierencadeaukaart',
        'PPMFWC_Gateway_Dankort',
        'PPMFWC_Gateway_DeCadeaukaart',
        'PPMFWC_Gateway_Dinerbon',
        'PPMFWC_Gateway_Eps',
        'PPMFWC_Gateway_Fashioncheque',
        'PPMFWC_Gateway_Fashiongiftcard',
        'PPMFWC_Gateway_FestivalCadeaukaart',
        'PPMFWC_Gateway_Flyingblueplus',
        'PPMFWC_Gateway_Focum',
        'PPMFWC_Gateway_Gezondheidsbon',
        'PPMFWC_Gateway_Giropay',
        'PPMFWC_Gateway_Givacard',
        'PPMFWC_Gateway_Googlepay',
        'PPMFWC_Gateway_HuisenTuinCadeau',
        'PPMFWC_Gateway_Ideal',
        'PPMFWC_Gateway_In3business',
        'PPMFWC_Gateway_Incasso',
        'PPMFWC_Gateway_Instore',
        'PPMFWC_Gateway_Kidsorteen',
        'PPMFWC_Gateway_Klarna',
        'PPMFWC_Gateway_Klarnakp',
        'PPMFWC_Gateway_Kunstencultuurkaart',
        'PPMFWC_Gateway_Maestro',
        'PPMFWC_Gateway_Mastercard',
        'PPMFWC_Gateway_Mbway',
        'PPMFWC_Gateway_Minitixsms',
        'PPMFWC_Gateway_Mistercash',
        'PPMFWC_Gateway_Mobilepay',
        'PPMFWC_Gateway_Monizze',
        'PPMFWC_Gateway_Mooigiftcard',
        'PPMFWC_Gateway_Multibanco',
        'PPMFWC_Gateway_Mybank',
        'PPMFWC_Gateway_Nationaletuinbon',
        'PPMFWC_Gateway_Nexi',
        'PPMFWC_Gateway_OkPayments',
        'PPMFWC_Gateway_Overboeking',
        'PPMFWC_Gateway_ParfumCadeaukaart',
        'PPMFWC_Gateway_OnlineBankbetaling',
        'PPMFWC_Gateway_P24',
        'PPMFWC_Gateway_Payconiq',
        'PPMFWC_Gateway_Paypal',
        'PPMFWC_Gateway_Paysafecard',
        'PPMFWC_Gateway_Phone',
        'PPMFWC_Gateway_Podiumcadeaukaart',
        'PPMFWC_Gateway_Postepay',
        'PPMFWC_Gateway_RotterdamCitycard',
        'PPMFWC_Gateway_Rvrpas',
        'PPMFWC_Gateway_Satispay',
        'PPMFWC_Gateway_Saunaandwellnesscadeaukaart',
        'PPMFWC_Gateway_Scholierenpas',
        'PPMFWC_Gateway_ShoesAndSneakers',
        'PPMFWC_Gateway_Sodexo',
        'PPMFWC_Gateway_Sofortbanking',
        'PPMFWC_Gateway_SofortbankingDigitalServices',
        'PPMFWC_Gateway_Spraypay',
        'PPMFWC_Gateway_StadspasAmsterdam',
        'PPMFWC_Gateway_Swish',
        'PPMFWC_Gateway_Tikkie',
        'PPMFWC_Gateway_Trustly',
        'PPMFWC_Gateway_Twint',
        'PPMFWC_Gateway_Upass',
        'PPMFWC_Gateway_Vipps',
        'PPMFWC_Gateway_Visa',
        'PPMFWC_Gateway_Visamastercard',
        'PPMFWC_Gateway_Vvvgiftcard',
        'PPMFWC_Gateway_Webshopgiftcard',
        'PPMFWC_Gateway_Wijncadeau',
        'PPMFWC_Gateway_Winkelcheque',
        'PPMFWC_Gateway_Wisselcadeaukaart',
        'PPMFWC_Gateway_Wechatpay',
        'PPMFWC_Gateway_Wero',
        'PPMFWC_Gateway_Wisselcadeaukaart',
        'PPMFWC_Gateway_XafaxMynetpay',
        'PPMFWC_Gateway_Yourgift',
        'PPMFWC_Gateway_YourGreenGiftCard',
        'PPMFWC_Gateway_Yehhpay',
    );

    /**
     * @param array $arrDefault
     * @return array
     * @phpcs:disable Squiz.Commenting.FunctionComment.TypeHintMissing
     */
    public static function ppmfwc_getGateways($arrDefault)
    {
        $paymentOptions = self::$arrGateways;

        $paymentOptionsAvailable = array();
        foreach ($paymentOptions as $paymentOption) {
            $optionId = call_user_func(array($paymentOption, 'getOptionId'));
            $available = PPMFWC_Helper_Data::isOptionAvailable($optionId);
            if ($available) {
                $paymentOptionsAvailable[] = $paymentOption;
            }
        }
        if (empty($paymentOptionsAvailable)) {
            $paymentOptionsAvailable = $paymentOptions;
        }

        return array_merge($arrDefault, $paymentOptionsAvailable);
    }

    /**
     * Add Settings Tab function
     * @param array $settings_tabs
     * @return array
     * @phpcs:disable Squiz.Commenting.FunctionComment.TypeHintMissing
     */
    public static function ppmfwc_addSettingsTab($settings_tabs)
    {
        $settings_tabs[self::TAB_ID] = __('Pay.', PPMFWC_WOOCOMMERCE_TEXTDOMAIN);
        return $settings_tabs;
    }

    /**
     * Add Sectcions function
     * @return array|void
     */
    public static function ppmfwc_addSettingsSections()
    {
        global $current_section;
        $sections = array(
            '' => __('Setup', PPMFWC_WOOCOMMERCE_TEXTDOMAIN),
            'payment_methods' => __('Payment Methods', PPMFWC_WOOCOMMERCE_TEXTDOMAIN),
            'settings' => __('Settings', PPMFWC_WOOCOMMERCE_TEXTDOMAIN),
            'order_state_automation' => __('Order State Automation', PPMFWC_WOOCOMMERCE_TEXTDOMAIN),
            'suggestions' => __('Suggestions?', PPMFWC_WOOCOMMERCE_TEXTDOMAIN)
        );
        echo '<ul class="subsubsub">';
        $array_keys = array_keys($sections);
        foreach ($sections as $id => $label) {
            echo '<li><a href="' . admin_url('admin.php?page=wc-settings&tab=' . self::TAB_ID . '&section=' . sanitize_title($id)) . '" class="' . ($current_section == $id ? 'current' : '') . '">' . $label . '</a> ' . (end($array_keys) == $id ? '' : '|') . ' </li>'; // phpcs:ignore
        }
        echo '</ul><br class="clear" />';
    }

    /**
     * Add Global Settings function
     * @phpcs:ignore Squiz.Commenting.FunctionComment.MissingReturn
     */
    public static function ppmfwc_addGlobalSettingsTab()
    {
        $settings = self::ppmfwc_addGlobalSettings();
        WC_Admin_Settings::output_fields($settings);
    }

    /**
     * Save Settings function
     * @phpcs:ignore Squiz.Commenting.FunctionComment.MissingReturn
     */
    public static function ppmfwc_saveGlobalSettingsTab()
    {
        global $current_section;

        $settings = self::ppmfwc_addGlobalSettings();
        WC_Admin_Settings::save_fields($settings);

        $section_id = $current_section;
        if ($section_id) {
            do_action('woocommerce_update_options_' . self::TAB_ID . '_' . $section_id);
        }
    }

    /**
     * @return string
     */
    public static function ppmfwc_checkCredentials()
    {
        $html = '';
        $warning = '';
        $error = '';
        try {
            PPMFWC_Helper_Data::loadPaymentMethods();
        } catch (Exception $e) {
            $current_apitoken = get_option('paynl_apitoken');
            $current_serviceid = get_option('paynl_serviceid');
            $current_tokencode = get_option('paynl_tokencode');
            $error = $e->getMessage();
            if (strlen($current_apitoken . $current_serviceid . $current_tokencode) == 0) {
                $post_apitoken = PPMFWC_Helper_Data::getPostTextField('paynl_apitoken');
                $post_serviceid = PPMFWC_Helper_Data::getPostTextField('paynl_serviceid');
                $post_tokencode = PPMFWC_Helper_Data::getPostTextField('paynl_tokencode');
                if (!empty($post_apitoken) || !empty($post_serviceid) || !empty($post_tokencode)) {
                    $error = __('API token and Sales Location are required.', PPMFWC_WOOCOMMERCE_TEXTDOMAIN);
                } else {
                    $warning = __('Pay. not connected.', PPMFWC_WOOCOMMERCE_TEXTDOMAIN);
                    ;
                }
            } elseif (strlen($current_apitoken . $current_serviceid) == 0) {
                $error = __('API token and Sales Location are required.', PPMFWC_WOOCOMMERCE_TEXTDOMAIN);
            } elseif (strlen($current_apitoken) == 0) {
                $error = __('API token is required.', PPMFWC_WOOCOMMERCE_TEXTDOMAIN);
            } elseif (strlen($current_serviceid) == 0) {
                $error = __('Sales Location (SL-code) is required.', PPMFWC_WOOCOMMERCE_TEXTDOMAIN);
            }

            switch ($error) {
                case 'HTTP/1.0 401 Unauthorized':
                    $error = __('Token Code, API token or Sales Location invalid.', PPMFWC_WOOCOMMERCE_TEXTDOMAIN);
                    break;
                case 'PAY-404 - Service not found':
                    $error = __('Sales Location is invalid.', PPMFWC_WOOCOMMERCE_TEXTDOMAIN);
                    break;
                case 'PAY-403 - Access denied: Token not valid for this company':
                    $error = __('Invalid Sales Location / API token combination.', PPMFWC_WOOCOMMERCE_TEXTDOMAIN);
                    break;
            }
        }

        if (strlen($warning) > 0) {
            $message = '<span style="color:#ff8300; font-weight:bold;">' . esc_html($warning) . '</span>';
            $message .= '<p class="description">' . esc_html(__('Not registered with Pay. yet? Sign up ', PPMFWC_WOOCOMMERCE_TEXTDOMAIN)) . '<a target="_blank" href="https://www.pay.nl/en/register-now">here</a>!</p>'; // phpcs:ignore
        } elseif (strlen($error) > 0) {
            $message = '<span style="color:#ff0000; font-weight:bold;">' . esc_html(__('Pay. connection failed.', PPMFWC_WOOCOMMERCE_TEXTDOMAIN)) . ' (' . esc_html($error) . ')</span>';
            $message .= '<p class="description">' . esc_html(__('We are experiencing technical issues. Please check ', PPMFWC_WOOCOMMERCE_TEXTDOMAIN)) . '<a target="_blank" href="https://status.pay.nl">status.pay.nl</a>' . esc_html(__('  for the latest update.', PPMFWC_WOOCOMMERCE_TEXTDOMAIN)) . '<br/>' . esc_html(__('You can set your failover gateway under ', PPMFWC_WOOCOMMERCE_TEXTDOMAIN)) . '<a href="' . admin_url('admin.php?page=wc-settings&tab=' . self::TAB_ID . '&section=settings') . '">' . esc_html(__('settings', PPMFWC_WOOCOMMERCE_TEXTDOMAIN)) . '</a>.</p>'; // phpcs:ignore
        } else {
            $message = '<span style="color:#10723a; font-weight:bold;">' . esc_html(__('Pay. successfully connected.', PPMFWC_WOOCOMMERCE_TEXTDOMAIN)) . '</span>';
        }

        $html .= '<table class="form-table">';
        $html .= '<tr valign="top">';
        $html .= '<th scope="row" class="titledesc">';
        $html .= '<label>Version</label>';
        $html .= '</th>';
        $html .= '<td class="forminp forminp-text">';
        $html .= PPMFWC_Helper_Data::getVersion();
        $html .= '</td>';
        $html .= '</tr>';

        $html .= '<tr valign="top">';
        $html .= '<th scope="row" class="titledesc">';
        $html .= '<label>Status</label>';
        $html .= '</th>';
        $html .= '<td class="forminp forminp-text">';
        $html .= $message;
        $html .= '</td>';
        $html .= '</tr>';
        $html .= '</table>';

        return $html;
    }

    /**
     * @return string
     */
    public static function ppmfwc_loadPaymentMethods()
    {
        $paymentOptions = self::$arrGateways;

        $enabledGateways = WC()->payment_gateways->get_available_payment_gateways();

        $paymentOptionsAvailable = array();
        foreach ($paymentOptions as $paymentOption) {
            $optionId = call_user_func(array($paymentOption, 'getOptionId'));
            $id = call_user_func(array($paymentOption, 'getId'));
            $name = call_user_func(array($paymentOption, 'getName'));

            $paymentOptionsAvailable[$optionId] = array(
                'optionId' => $optionId,
                'name' => $name,
                'id' => $id,
                'enabled' => (isset($enabledGateways[$id]))
            );
        }
        $loadedPaymentMethods = '';
        try {
            PPMFWC_Helper_Data::loadPaymentMethods();
            $arrOptions = PPMFWC_Helper_Data::getOptions();
            $loadedPaymentMethods .= '<br /><br />' . esc_html(__('The following payment methods can be enabled, please select a payment method to open the settings:', PPMFWC_WOOCOMMERCE_TEXTDOMAIN));
            $loadedPaymentMethods .= '<ul>';
            foreach ($arrOptions as $option) {
                if (isset($paymentOptionsAvailable[$option['id']])) {
                    $section = $paymentOptionsAvailable[$option['id']]['id'];
                    $enabled = $paymentOptionsAvailable[$option['id']]['enabled'];
                    $href = admin_url('/admin.php?page=wc-settings&tab=checkout&section=' . $section);
                    $loadedPaymentMethods .= '<li><a href="' . $href . '"><img height="50px" src="' . esc_attr($option['image']) . '" alt="' . esc_attr($option['name'])
                        . '" title="' . esc_attr($option['name']) . '" />' . esc_attr($option['name']) . ($enabled ? '<span class="enabled">&#10003;</span>' : '') . '</a></li>';
                }
            }
            $loadedPaymentMethods .= '</ul>';
            $loadedPaymentMethods .= '<div class="clear"></div>';
        } catch (Exception $e) {
            return false;
        }

        return $loadedPaymentMethods;
    }

     /**
     * @return string
     */
    public static function ppmfwc_loadSuggestionForm()
    {
        $form = '<br /><br />' . esc_html(__('If you have a feature request or other ideas, let us know!', PPMFWC_WOOCOMMERCE_TEXTDOMAIN));
        $form .= '<br />' . esc_html(__('Your submission will be reviewed by our development team.', PPMFWC_WOOCOMMERCE_TEXTDOMAIN));
        $form .= '<br />' . esc_html(__('If needed, we will contact you for further information via the e-mail address provided.', PPMFWC_WOOCOMMERCE_TEXTDOMAIN));
        $form .= '<br />' . esc_html(__('Please note: this form is not for Support requests, please contact support@pay.nl for this.', PPMFWC_WOOCOMMERCE_TEXTDOMAIN));

        $form .= '<table class="form-table" id="pay_feature_request_form">';
        $form .= '<tbody><tr>';
        $form .= '<th scope="row" class="titledesc"><label>' . esc_html(__('Email (optional)', PPMFWC_WOOCOMMERCE_TEXTDOMAIN)) . '</label><span id="email_error" class="FR_Error">' . esc_html(__('Please fill in a valid email.', PPMFWC_WOOCOMMERCE_TEXTDOMAIN)) . '</span></th>'; // phpcs:ignore
        $form .= '<td class="forminp forminp-text"><textarea id="FR_Email" name="FR_Email"></textarea></td>';
        $form .= '</tr>';
        $form .= '<tr>';
        $form .= '<th scope="row" class="titledesc"><label>' . esc_html(__('Message', PPMFWC_WOOCOMMERCE_TEXTDOMAIN)) . '*</label><span id="message_error" class="FR_Error">' . esc_html(__('Please fill in a message.', PPMFWC_WOOCOMMERCE_TEXTDOMAIN)) . '</span></th>'; // phpcs:ignore
        $form .= '<td class="forminp forminp-text"><textarea id="FR_Message" name="FR_Message"></textarea></td>';
        $form .= '</tr>';
        $form .= '</tbody></table>';
        $form .= '<button id="FR_Submit" class="button-primary">' . esc_html(__('Send', PPMFWC_WOOCOMMERCE_TEXTDOMAIN)) . '</button>';
        $form .= '<div class="clear"></div>';
        $form .= '<div class="FR_Alertbox" id="FR_Alert_Success"><div class="FR_Alert"><p>' . esc_html(__('Sent! Thank you for your contribution.', PPMFWC_WOOCOMMERCE_TEXTDOMAIN)) . '</p><span class="FR_close_alert">' . esc_html(__('Close', PPMFWC_WOOCOMMERCE_TEXTDOMAIN)) . '</span></div></div>'; // phpcs:ignore
        $form .= '<div class="FR_Alertbox" id="FR_Alert_Fail"><div class="FR_Alert"><p>' . esc_html(__('Couldn\'t send email.', PPMFWC_WOOCOMMERCE_TEXTDOMAIN)) . '</p><span class="FR_close_alert">' . esc_html(__('Close', PPMFWC_WOOCOMMERCE_TEXTDOMAIN)) . '</span></div></div>'; // phpcs:ignore
        return $form;
    }

    /**
     * @return array
     */
    public static function ppmfwc_addGlobalSettings()
    {
        global $current_section;

        $addedSettings = array();

        if ($current_section == 'suggestions') {
            $suggestionForm = self::ppmfwc_loadSuggestionForm();
            $addedSettings[] = array(
                'title' => esc_html(__('Pay. Suggestion?', PPMFWC_WOOCOMMERCE_TEXTDOMAIN)),
                'type' => 'title',
                'desc' => '<p>' . $suggestionForm . '</p>',
                'id' => 'paynl_payment_suggestions',
            );
        } elseif ($current_section == 'payment_methods') {
            $loadedPaymentMethods = self::ppmfwc_loadPaymentMethods();
            if ($loadedPaymentMethods) {
                $addedSettings[] = array(
                    'title' => esc_html(__('Pay. Payment Methods', PPMFWC_WOOCOMMERCE_TEXTDOMAIN)),
                    'type' => 'title',
                    'desc' => '<p>' . $loadedPaymentMethods . '</p>',
                    'id' => 'paynl_payment_methods',
                );
            } else {
                $addedSettings[] = array(
                    'title' => esc_html(__('Pay. Payment Methods', PPMFWC_WOOCOMMERCE_TEXTDOMAIN)),
                    'type' => 'title',
                    'desc' => esc_html(__('Complete connecting your Pay. account on the ', PPMFWC_WOOCOMMERCE_TEXTDOMAIN))
                        . '<a href="' . admin_url('/admin.php?page=wc-settings&tab=pay_settings') . '">' . esc_html(__('setup page', PPMFWC_WOOCOMMERCE_TEXTDOMAIN)) . '</a>',
                    'id' => 'paynl_payment_methods',
                );
            }
            $addedSettings[] = array(
                'type' => 'sectionend',
                'id' => 'paynl_payment_methods',
            );
        } elseif ($current_section == 'order_state_automation') {
            $addedSettings[] = array(
                'title' => esc_html(__('Pay. Order State Automation', PPMFWC_WOOCOMMERCE_TEXTDOMAIN)),
                'type' => 'title',
                'desc' => '',
                'id' => 'paynl_order_state_automation',
            );
            $statusSettings = [
                'paid' => ['processing', PPMFWC_Gateway_Abstract::STATUS_PROCESSING],
                'cancel' => ['cancelled', PPMFWC_Gateway_Abstract::STATUS_CANCELLED, [
                    PPMFWC_Gateway_Abstract::STATUS_PROCESSING, PPMFWC_Gateway_Abstract::STATUS_REFUNDED,
                    PPMFWC_Gateway_Abstract::STATUS_COMPLETED, PPMFWC_Gateway_Abstract::STATUS_ON_HOLD
                ]],
                'failed' => ['failed', PPMFWC_Gateway_Abstract::STATUS_FAILED],
                'authorized' => ['processing', PPMFWC_Gateway_Abstract::STATUS_PROCESSING],
                'verify' => ['on-hold', PPMFWC_Gateway_Abstract::STATUS_ON_HOLD],
                'chargeback' => ['off', 'off']
            ];

            foreach ($statusSettings as $statusname => $statusValues) {
                $addedSettings[] = array(
                    'id' => 'paynl_status_' . $statusname,
                    'name' => esc_html(__('Pay. status ' . strtoupper($statusname), PPMFWC_WOOCOMMERCE_TEXTDOMAIN)),
                    'type' => 'select',
                    'options' => self::getAvailableWoocomStatus($statusValues[0], isset($statusValues[2]) ? $statusValues[2] : array()),
                    'default' => $statusValues[1],
                    'desc' => sprintf(esc_html(__('Select which status an order should have when Pay\'s transaction status is %s', PPMFWC_WOOCOMMERCE_TEXTDOMAIN)), strtoupper($statusname))
                );
            }
            $addedSettings[] = array(
                'type' => 'sectionend',
                'id' => 'paynl_order_state_automation',
            );
        } elseif ($current_section == 'settings') {
            $addedSettings[] = array(
                'title' => esc_html(__('Pay. Settings', PPMFWC_WOOCOMMERCE_TEXTDOMAIN)),
                'type' => 'title',
                'desc' => '',
                'id' => 'paynl_global_settings',
            );
            $addedSettings[] = array(
                'name' => __('Pay. checkout style', PPMFWC_WOOCOMMERCE_TEXTDOMAIN),
                'type' => 'checkbox',
                'desc' => esc_html(__('Select this box to apply a style preset to the checkout with names to the left and logo\'s to the right.', PPMFWC_WOOCOMMERCE_TEXTDOMAIN)),
                'id' => 'paynl_standard_style',
                'default' => 'yes',
            );
            $addedSettings[] = array(
                'name' => __('Payment screen language', PPMFWC_WOOCOMMERCE_TEXTDOMAIN),
                'type' => 'select',
                'options' => PPMFWC_Helper_Data::ppmfwc_getAvailableLanguages(),
                'desc' => esc_html(__('Select the language in which payment screens should open', PPMFWC_WOOCOMMERCE_TEXTDOMAIN)),
                'id' => 'paynl_language',
                'default' => 'browser',
            );
            $addedSettings[] = array(
                'name' => __('Refund processing', PPMFWC_WOOCOMMERCE_TEXTDOMAIN),
                'type' => 'checkbox',
                'desc' => esc_html(__("Process refunds in WooCommerce that are initiated in My.pay", PPMFWC_WOOCOMMERCE_TEXTDOMAIN)),
                'id' => 'paynl_externalrefund',
                'default' => 'no',
            );
            $addedSettings[] = array(
                'name' => esc_html(__('Auto capture', PPMFWC_WOOCOMMERCE_TEXTDOMAIN)),
                'type' => 'checkbox',
                'desc' => esc_html(__('Enable auto capture for authorized transactions. Captures will be initiated when an order is set to Completed.', PPMFWC_WOOCOMMERCE_TEXTDOMAIN)),
                'id' => 'paynl_auto_capture',
                'default' => 'no',
            );
            $addedSettings[] = array(
                'name' => esc_html(__('Auto void', PPMFWC_WOOCOMMERCE_TEXTDOMAIN)),
                'type' => 'checkbox',
                'desc' => esc_html(__('Enable auto void for authorized transactions. Voids will be initiated when an order is set to Cancelled.', PPMFWC_WOOCOMMERCE_TEXTDOMAIN)),
                'id' => 'paynl_auto_void',
                'default' => 'no',
            );
            $addedSettings[] = array(
                'name' => esc_html(__('Show VAT number', PPMFWC_WOOCOMMERCE_TEXTDOMAIN)),
                'type' => 'select',
                'options' => array(
                    'no' => esc_html(__('No', PPMFWC_WOOCOMMERCE_TEXTDOMAIN)),
                    'yes' => esc_html(__('Optional for business customers', PPMFWC_WOOCOMMERCE_TEXTDOMAIN)),
                    'yes_required' => esc_html(__('Required for business customers', PPMFWC_WOOCOMMERCE_TEXTDOMAIN)),
                ),
                'desc' => esc_html(__('Enable to add an extra field to the checkout for customers to enter their VAT number', PPMFWC_WOOCOMMERCE_TEXTDOMAIN)),
                'id' => 'paynl_show_vat_number',
                'default' => 'no',
            );
            $addedSettings[] = array(
                'name' => esc_html(__('Show COC number', PPMFWC_WOOCOMMERCE_TEXTDOMAIN)),
                'type' => 'select',
                'options' => array(
                    'no' => esc_html(__('No', PPMFWC_WOOCOMMERCE_TEXTDOMAIN)),
                    'yes' => esc_html(__('Optional for business customers', PPMFWC_WOOCOMMERCE_TEXTDOMAIN)),
                    'yes_required' => esc_html(__('Required for business customers', PPMFWC_WOOCOMMERCE_TEXTDOMAIN)),
                ),
                'desc' => esc_html(__('Enable to add an extra field to the checkout for customers to enter their COC number', PPMFWC_WOOCOMMERCE_TEXTDOMAIN)),
                'id' => 'paynl_show_coc_number',
                'default' => 'no',
            );
            $addedSettings[] = array(
                'name' => esc_html(__('Order description prefix', PPMFWC_WOOCOMMERCE_TEXTDOMAIN)),
                'type' => 'text',
                'placeholder' => '',
                'desc' => esc_html(__('Optionally add a custom order description prefix. Use a double underscore to add an extra space', PPMFWC_WOOCOMMERCE_TEXTDOMAIN)),
                'id' => 'paynl_order_description_prefix',
            );
            $addedSettings[] = array(
                'name' => esc_html(__('Follow payment method', PPMFWC_WOOCOMMERCE_TEXTDOMAIN)),
                'type' => 'select',
                'options' => array(0 => esc_html(__('No', PPMFWC_WOOCOMMERCE_TEXTDOMAIN)), 1 => esc_html(__('Yes', PPMFWC_WOOCOMMERCE_TEXTDOMAIN))),
                'desc' => esc_html(__('Default set to Yes. This will ensure the order is updated with the actual payment method used to complete the order. This can differ from the payment method initially selected', PPMFWC_WOOCOMMERCE_TEXTDOMAIN)), // phpcs:ignore
                'id' => 'paynl_payment_method_display',
                'default' => 1,
            );

            $addedSettings[] = array(
              'css' => 'padding-bottom:40px;display:block;color:#f0f0f1',
              'type' => 'info',
              'text' => '<h2 class="paynl_advanced_settings_title">' . esc_html(__('Advanced settings', PPMFWC_WOOCOMMERCE_TEXTDOMAIN)) . '</h2>'
            );

            $addedSettings[] = array(
                'name' => esc_html(__('Test IP address', PPMFWC_WOOCOMMERCE_TEXTDOMAIN)),
                'type' => 'text',
                'desc' => esc_html(__('Transactions started from these IP addresses will use testmode. Comma separate IPs for multiple inputs', PPMFWC_WOOCOMMERCE_TEXTDOMAIN)) . '<br/>' . esc_html(__('Current IP address:', PPMFWC_WOOCOMMERCE_TEXTDOMAIN)) . PPMFWC_Helper_Data::getIp(), // phpcs:ignore
                'id' => 'paynl_test_ipadress',
            );
            $addedSettings[] = array(
                'name' => __('Alternative exchange URL', PPMFWC_WOOCOMMERCE_TEXTDOMAIN),
                'type' => 'text',
                'placeholder' => 'https://www.yourdomain.nl/exchange_handler',
                'desc' => esc_html(__('Use your own exchange-handler. Requests will be send as GET.', PPMFWC_WOOCOMMERCE_TEXTDOMAIN)) . '<br>' .
                    esc_html(__('Example: https://www.yourdomain.nl/exchange_handler?action=#action#&order_id=#order_id#', PPMFWC_WOOCOMMERCE_TEXTDOMAIN)) . '<br>' .
                    esc_html(__('For more info see: ', PPMFWC_WOOCOMMERCE_TEXTDOMAIN)) . '<a href="https://docs.pay.nl/developers#exchange-parameters">docs.pay.nl</a>',
                'id' => 'paynl_exchange_url'
            );
            $addedSettings[] = array(
                'name' => __('Multicore', PPMFWC_WOOCOMMERCE_TEXTDOMAIN),
                'type' => 'select',
                'options' => PPMFWC_Helper_Data::ppmfwc_getGateways(),
                'desc' => esc_html(__('Select the core which will be used for processing payments', PPMFWC_WOOCOMMERCE_TEXTDOMAIN)),
                'id' => 'paynl_failover_gateway',
                'default' => 'nl',
            );
            $addedSettings[] = array(
                'name' => esc_html(__('Custom multicore', PPMFWC_WOOCOMMERCE_TEXTDOMAIN)),
                'type' => 'text',
                'placeholder' => '',
                'desc' => esc_html(__('Leave this empty unless advised otherwise by Pay. Support', PPMFWC_WOOCOMMERCE_TEXTDOMAIN)),
                'id' => 'paynl_custom_failover_gateway',
            );
            $addedSettings[] = array(
                'name' => __('Customer IP', PPMFWC_WOOCOMMERCE_TEXTDOMAIN),
                'type' => 'select',
                'options' => array(
                    'default' => esc_html(__('Default (Pay. SDK)', PPMFWC_WOOCOMMERCE_TEXTDOMAIN)),
                    'orderremoteaddress' => esc_html(__('WooCommerce Order IP', PPMFWC_WOOCOMMERCE_TEXTDOMAIN)),
                    'httpforwarded' => esc_html(__('HTTP forwarded', PPMFWC_WOOCOMMERCE_TEXTDOMAIN)),
                    'remoteaddress' => esc_html(__('Remote address', PPMFWC_WOOCOMMERCE_TEXTDOMAIN)),
                ),
                'desc' => esc_html(__('Choose how customer IP is determined.', PPMFWC_WOOCOMMERCE_TEXTDOMAIN)),
                'desc_tip' => __('This setting allows you to define which customer IP is sent to Pay when initiating a transaction. If the default IP address doesn\'t work as expected, you can manually select an alternative here.', PPMFWC_WOOCOMMERCE_TEXTDOMAIN),
                'id' => 'paynl_customer_ip',
                'default' => 'default',
            );
            $addedSettings[] = array(
                'name' => esc_html(__('SSL verification', PPMFWC_WOOCOMMERCE_TEXTDOMAIN)),
                'type' => 'checkbox',
                'desc' => esc_html(__('Enabled by default for secure communications. Strongly recommended to leave this enabled, unless otherwise advised by Pay. Support.', PPMFWC_WOOCOMMERCE_TEXTDOMAIN)), // phpcs:ignore
                'id' => 'paynl_verify_peer',
                'default' => 'yes',
            );
            $addedSettings[] = array(
                'name' => __('Extended logging', PPMFWC_WOOCOMMERCE_TEXTDOMAIN),
                'type' => 'checkbox',
                'desc' => esc_html(__("Log payment information. Logfiles can be found at: WooCommerce > Status > Logs", PPMFWC_WOOCOMMERCE_TEXTDOMAIN)),
                'id' => 'paynl_paylogger',
                'default' => 'yes',
            );


            $addedSettings[] = array(
              'name' => __('Use high risk methods', PPMFWC_WOOCOMMERCE_TEXTDOMAIN),
              'type' => 'checkbox',
              'desc' => esc_html(__("Enable when you are using high risk payment methods", PPMFWC_WOOCOMMERCE_TEXTDOMAIN)),
              'id' => 'paynl_high_risk',
              'default' => 'no',
            );


            $addedSettings[] = array(
                'type' => 'sectionend',
                'id' => 'paynl_global_settings',
            );
        } else {
            $status = '';

            $post_apitoken = PPMFWC_Helper_Data::getPostTextField('paynl_apitoken');
            $post_serviceid = PPMFWC_Helper_Data::getPostTextField('paynl_serviceid');
            $post_tokencode = PPMFWC_Helper_Data::getPostTextField('paynl_tokencode');

            if (!empty($post_apitoken) || !empty($post_serviceid) || !empty($post_tokencode)) {
                $current_apitoken = get_option('paynl_apitoken');
                $current_serviceid = get_option('paynl_serviceid');
                $current_tokencode = get_option('paynl_tokencode');
                if (($post_apitoken == $current_apitoken) && ($post_serviceid == $current_serviceid) && ($post_tokencode == $current_tokencode)) {
                    $status = self::ppmfwc_checkCredentials();
                }
            } else {
                $status = self::ppmfwc_checkCredentials();
            }
            $addedSettings[] = array(
                'title' => esc_html(__('Pay. Setup', PPMFWC_WOOCOMMERCE_TEXTDOMAIN)),
                'type' => 'title',
                'desc' => $status,
                'id' => 'paynl_setup',
            );
            $addedSettings[] = array(
                'name' => esc_html(__('Token Code *', PPMFWC_WOOCOMMERCE_TEXTDOMAIN)),
                'placeholder' => 'AT-####-####',
                'type' => 'text',
                'desc' => esc_html(
                    __(
                        'The AT-code belonging to your API token, you can find this ',
                        PPMFWC_WOOCOMMERCE_TEXTDOMAIN
                    )
                ) . '<a href="https://admin.pay.nl/company/tokens" target="api_token">' . esc_html(__('here', PPMFWC_WOOCOMMERCE_TEXTDOMAIN)) . '</a>',
                'id' => 'paynl_tokencode',
            );
            $addedSettings[] = array(
                'name' => esc_html(__('API token', PPMFWC_WOOCOMMERCE_TEXTDOMAIN)),
                'type' => 'text',
                'desc' => esc_html(
                    __(
                        'The API token used to communicate with the Pay. API, you can find your API token ',
                        PPMFWC_WOOCOMMERCE_TEXTDOMAIN
                    )
                ) . '<a href="https://admin.pay.nl/company/tokens" target="api_token">' . esc_html(__('here', PPMFWC_WOOCOMMERCE_TEXTDOMAIN)) . '</a>',
                'id' => 'paynl_apitoken',
                'class' => 'obscuredInput',
            );
            $addedSettings[] = array(
                'name' => esc_html(__('Sales Location *', PPMFWC_WOOCOMMERCE_TEXTDOMAIN)),
                'placeholder' => 'SL-####-####',
                'type' => 'text',
                'desc' => esc_html(
                    __(
                        'The SL-code of your Sales Location, you can find your SL-code ',
                        PPMFWC_WOOCOMMERCE_TEXTDOMAIN
                    )
                ) . '<a href="https://admin.pay.nl/programs/programs" target="serviceid">' . esc_html(__('here', PPMFWC_WOOCOMMERCE_TEXTDOMAIN)) . '</a>',
                'id' => 'paynl_serviceid',
                'desc_tip' => __('The Sales Location should be in the following format: SL-xxxx-xxxx', PPMFWC_WOOCOMMERCE_TEXTDOMAIN),
            );
            $addedSettings[] = array(
                'name' => esc_html(__('Test mode', PPMFWC_WOOCOMMERCE_TEXTDOMAIN)),
                'type' => 'checkbox',
                'desc' => esc_html(__('Enable to start transactions in test mode', PPMFWC_WOOCOMMERCE_TEXTDOMAIN)),
                'id' => 'paynl_test_mode',
                'default' => 'no',
            );
            $addedSettings[] = array(
                'type' => 'sectionend',
                'id' => 'paynl_setup',
            );
        }

        return $addedSettings;
    }

    /**
     * This function registers the Pay Payment Gateways
     * @phpcs:ignore Squiz.Commenting.FunctionComment.MissingReturn
     */
    public static function ppmfwc_register()
    {
        add_filter('woocommerce_payment_gateways', array(__CLASS__, 'ppmfwc_getGateways'));
    }

    /**
     * @phpcs:ignore Squiz.Commenting.FunctionComment.MissingReturn
     */
    public static function ppmfwc_addPayStyleSheet()
    {
        wp_register_style('paynl_wp_admin_css', PPMFWC_PLUGIN_URL . 'assets/css/pay.css', false, PPMFWC_Helper_Data::getVersion());
        wp_enqueue_style('paynl_wp_admin_css');
    }

    /**
     * @phpcs:ignore Squiz.Commenting.FunctionComment.MissingReturn
     */
    public static function ppmfwc_addPayJavascript()
    {
        wp_register_script('paynl_wp_admin_js', PPMFWC_PLUGIN_URL . 'assets/js/pay.js', array('jquery'), PPMFWC_Helper_Data::getVersion(), true);
        wp_enqueue_script('paynl_wp_admin_js');
    }

    /**
     * This function adds the Pay Settings Tab
     * @phpcs:ignore Squiz.Commenting.FunctionComment.MissingReturn
     */
    public static function ppmfwc_settingsTab()
    {
        add_action('admin_enqueue_scripts', array(__CLASS__, 'ppmfwc_addPayStyleSheet'));
        add_action('admin_enqueue_scripts', array(__CLASS__, 'ppmfwc_addPayJavascript'));
        add_action('admin_enqueue_scripts', array(__CLASS__, 'enqueue_custom_admin_js'));
        add_filter('woocommerce_settings_tabs_array', array(__CLASS__, 'ppmfwc_addSettingsTab'), 50);
        add_action('woocommerce_sections_' . self::TAB_ID, array(__CLASS__, 'ppmfwc_addSettingsSections'));
        add_action('woocommerce_settings_' . self::TAB_ID, array(__CLASS__, 'ppmfwc_addGlobalSettingsTab'), 10);
        add_action('woocommerce_settings_save_' . self::TAB_ID, array(__CLASS__, 'ppmfwc_saveGlobalSettingsTab'), 10);
    }


    /**
     * @return void
     */
    public static function enqueue_custom_admin_js()
    {
        $section = PPMFWC_Helper_Data::getRequestArg('section') ?? null;
        if ($section == 'pay_gateway_instore') {
            wp_enqueue_script('custom-admin-script', PPMFWC_PLUGIN_URL . 'assets/js/instore_setting.js', array('jquery'), PPMFWC_Helper_Data::getVersion(), true);
        }
    }

    /**
     * Register the API's to catch the return and exchange
     * @phpcs:ignore Squiz.Commenting.FunctionComment.MissingReturn
     */
    public static function ppmfwc_registerApi()
    {
        add_action('woocommerce_api_wc_pay_gateway_return', array(__CLASS__, 'ppmfwc_onReturn'));
        add_action('woocommerce_api_wc_pay_gateway_exchange', array(__CLASS__, 'ppmfwc_onExchange'));
        add_action('woocommerce_api_wc_pay_gateway_featurerequest', array(__CLASS__, 'ppmfwc_onFeatureRequest'));
        add_action('woocommerce_api_wc_pay_gateway_pinrefund', array(__CLASS__, 'ppmfwc_onPinRefund'));
        add_action('woocommerce_api_wc_pay_gateway_fccreate', array('PPMFWC_Hooks_FastCheckout_Start', 'ppmfwc_onFastCheckoutOrderCreate'));
        add_action('woocommerce_api_wc_pay_gateway_pintransaction', array(__CLASS__, 'ppmfwc_onPinRefund'));
    }

    /**
     * After a (successfull, failed, cancelled etc.) PAY payment the user wil end up here
     * @phpcs:ignore Squiz.Commenting.FunctionComment.MissingReturn
     */
    public static function ppmfwc_onReturn()
    {
        $url = wc_get_checkout_url();

        $transactionId = PPMFWC_Helper_Data::getRequestArg('id');
        $statusCode = PPMFWC_Helper_Data::getRequestArg('statusCode');

        $orderStatusId = isset($_GET['orderStatusId']) ? sanitize_text_field($_GET['orderStatusId']) : false;
        $orderStatusId = (empty($orderStatusId) && !empty($statusCode)) ? $statusCode : $orderStatusId;

        $orderId = isset($_GET['orderId']) ? sanitize_text_field($_GET['orderId']) : false;
        $orderId = (empty($orderId) && !empty($transactionId)) ? $transactionId : $orderId;

        $status = self::ppmfwc_getStatusFromStatusId($orderStatusId);

        PPMFWC_Helper_Data::ppmfwc_payLogger('FINISH, back from PAY payment', $orderId, array('orderStatusId' => $orderStatusId, 'status' => $status));

        try {
            # Retrieve URL to continue (and update status if necessary)
            if (!empty($orderId)) {
                $newStatus = PPMFWC_Helper_Transaction::processTransaction($orderId, $status);
                try {
                    $transactionLocalDB = PPMFWC_Helper_Transaction::getTransaction($orderId);
                    if (!$transactionLocalDB || empty($transactionLocalDB['order_id'])) {
                        throw new PPMFWC_Exception_Notice('Could not find local transaction for order ' . $orderId);
                    }
                    $order = new WC_Order($transactionLocalDB['order_id']);

                    $url = self::getOrderReturnUrl($order, $newStatus);
                } catch (Exception $e) {
                    PPMFWC_Helper_Data::ppmfwc_payLogger('Exception: ' . $e->getMessage(), $orderId);
                }
            }
        } catch (PPMFWC_Exception_Notice $e) {
            PPMFWC_Helper_Data::ppmfwc_payLogger('Could not retrieve url to continue: ' . $e->getMessage(), $orderId);
        } catch (Exception $e) {
            PPMFWC_Helper_Data::ppmfwc_payLogger('Could not retrieve url to continue: ' . $e->getMessage(), $orderId, array(), 'error');
        }

        wp_redirect($url);
    }

    /**
     * @param WC_Order $order
     * @param string $newStatus
     * @return array
     */
    public static function getOrderReturnUrl(WC_Order $order, $newStatus)
    {
        if ($newStatus == PPMFWC_Gateways::STATUS_CANCELED) {
            $url = add_query_arg('paynl_status', PPMFWC_Gateways::STATUS_CANCELED, wc_get_checkout_url());
        } elseif ($newStatus == PPMFWC_Gateways::STATUS_DENIED) {
            $methodName = $order->get_payment_method_title();
            if (!empty($methodName)) {
                wc_add_notice(
                    esc_html(
                        sprintf(
                            __(
                                'Unfortunately the payment has been denied by %s. Please try again or use another payment method.',
                                PPMFWC_WOOCOMMERCE_TEXTDOMAIN
                            ),
                            $methodName
                        )
                    ),
                    'error'
                );
            } else {
                wc_add_notice(esc_html(__('Unfortunately the payment has been denied by the payment method. Please try again or use another payment method.', PPMFWC_WOOCOMMERCE_TEXTDOMAIN)), 'error');
            }

            $url = add_query_arg('paynl_status', PPMFWC_Gateways::STATUS_DENIED, wc_get_checkout_url());
        } elseif ($newStatus == PPMFWC_Gateways::STATUS_PENDING) {
            $url = add_query_arg('paynl_status', PPMFWC_Gateways::STATUS_PENDING, $order->get_checkout_order_received_url());

            $method = $order->get_payment_method();
            $methodSettings = get_option('woocommerce_' . $method . '_settings');

            if (!empty($methodSettings['alternative_return_url'])) {
                $url = $methodSettings['alternative_return_url'];
            }
        } else {
            $return_url = $order->get_checkout_order_received_url();
            if (is_ssl() || get_option('woocommerce_force_ssl_checkout') == 'yes') {
                $return_url = str_replace('http:', 'https:', $return_url);
            }

            $url = apply_filters('woocommerce_get_return_url', $return_url, $order);
        }

        return $url;
    }


    /**
     * Retrieve a textual-status by statusId
     *
     * @param integer $statusId
     * @return string
     */
    public static function ppmfwc_getStatusFromStatusId($statusId)
    {
        $status = null;
        if ($statusId == 100) {
            $status = self::STATUS_SUCCESS;
        } elseif ($statusId == 95) {
            $status = self::STATUS_AUTHORIZE;
        } elseif ($statusId == 85) {
            $status = self::STATUS_VERIFY;
        } elseif ($statusId == -81) {
            $status = self::STATUS_REFUND;
        } elseif ($statusId == -82) {
            $status = self::STATUS_REFUND_PARTIALLY;
        } elseif ($statusId == -63) {
            $status = self::STATUS_DENIED;
        } elseif (in_array($statusId, array(20, 25, 50, 90))) {
            $status = self::STATUS_PENDING;
        } elseif ($statusId < 0) {
            $status = self::STATUS_CANCELED;
        }

        return $status;
    }

    /**
     * Converts Pay. actions into the correct status
     *
     * @return mixed
     */
    public static function ppmfwc_getPayActions()
    {
        $arrPayActions[self::ACTION_NEWPPT] = self::STATUS_SUCCESS;
        $arrPayActions[self::ACTION_PENDING] = self::STATUS_PENDING;
        $arrPayActions[self::ACTION_CANCEL] = self::STATUS_CANCELED;
        $arrPayActions[self::ACTION_VERIFY] = self::STATUS_VERIFY;
        $arrPayActions[self::ACTION_REFUND] = self::STATUS_REFUND;
        $arrPayActions[self::ACTION_CAPTURE] = self::STATUS_CAPTURE;
        $arrPayActions[self::ACTION_CAPTURE] = self::STATUS_CAPTURE;
        $arrPayActions[self::ACTION_CHARGEBACK] = self::STATUS_CHARGEBACK;
        $arrPayActions[self::ACTION_PINREFUND] = self::STATUS_PINREFUND;
        return $arrPayActions;
    }

    /**
     * Return Gateway object based on payment_profile_id
     *
     * @param integer $payment_profile_id
     * @return mixed|null
     */
    public static function ppmfwc_getGateWayById($payment_profile_id)
    {
        foreach (self::$arrGateways as $strGateway) {
            $optionId = call_user_func(array($strGateway, 'getOptionId'));
            if (!empty($optionId) && $payment_profile_id == $optionId) {
                return new $strGateway();
            }
        }
        return null;
    }

    /**
     * @return array
     * @throws Exception
     * @phpcs:disable Squiz.Commenting.FunctionComment.TypeHintMissing
     */
    private static function getPayLoad()
    {
        $action = strtolower(PPMFWC_Helper_Data::getRequestArg('action')) ?? null;
        if (!empty($action)) {
            # The argument "action" tells us this is not coming from TGU
            $paymentProfile = PPMFWC_Helper_Data::getRequestArg('payment_profile_id') ?? null;
            $payOrderId = PPMFWC_Helper_Data::getRequestArg('order_id') ?? null;
            $orderId = PPMFWC_Helper_Data::getRequestArg('extra1') ?? null;
            $extra3 = PPMFWC_Helper_Data::getRequestArg('extra3') ?? null;
            $data = null;
        } else {
            if (wp_is_json_request()) {
                $rawBody = file_get_contents('php://input');
                $data = json_decode($rawBody, true, 512, 4194304);
                $exchangeType = $data['type'] ?? null;
                if ($exchangeType != 'order') {
                    throw new Exception('Cant handle exchange type other then order');
                }
            } else {
                $data = $_REQUEST ?? null;
            }

            $payOrderId = $data['object']['orderId'] ?? '';
            $internalStateId = $data['object']['status']['code'] ?? '';
            $internalStateName = $data['object']['status']['action'] ?? '';
            $orderId = $data['object']['reference'] ?? '';
            $extra3 = $data['object']['extra3'] ?? null;
            $type = $data['object']['type'] ?? '';
            switch ($internalStateId) {
                case 100:
                case 98:
                case 95:
                    $action = 'new_ppt';
                    break;
                case 85:
                    $action = 'verify';
                    break;
                case -90:
                case -80:
                case -63:
                    $action = 'cancel';
                    break;
                default:
                    $action = 'pending';
                    break;
            }
            $checkoutData = $data['object']['checkoutData'] ?? '';
        }

        # Return mapped data so it works for all type of exchanges.
        return [
            'action' => $action,
            'paymentProfile' => $paymentProfile ?? null,
            'payOrderId' => $payOrderId,
            'orderId' => $orderId,
            'extra3' => $extra3 ?? null,
            'internalStateId' => $internalStateId ?? null,
            'internalStateName' => $internalStateName ?? null,
            'checkoutData' => $checkoutData ?? null,
            'orgData' => $data,
            'type' => $type ?? null,
        ];
    }

    /**
     * Handles the Pay. Exchange requests
     * @phpcs:ignore Squiz.Commenting.FunctionComment.MissingReturn
     */
    public static function ppmfwc_onExchange()
    {
        $params = self::getPayLoad();

        $action = $params['action'];
        $order_id = (string) $params['payOrderId'];
        $wc_order_id = (string) $params['orderId'];
        $methodId = $params['paymentProfile'];

        if ($methodId == PPMFWC_Gateway_Abstract::PAYMENT_METHOD_PINREFUND && $action == self::ACTION_NEWPPT) {
            $action = self::ACTION_PINREFUND;
        }

        $arrActions = self::ppmfwc_getPayActions();
        $message = 'TRUE|Ignoring ' . $action;

        ob_start();
        try {
            if ($action == self::ACTION_NEWPPT) {
                if (PPMFWC_Helper_Transaction::checkProcessing($order_id)) {
                    die('FALSE| Already processing payment');
                }
            }
            if (in_array($action, array_keys($arrActions))) {
                $status = $arrActions[$action];
            } else {
                throw new PPMFWC_Exception_Notice('Ignoring: ' . $action);
            }

            if (!in_array($action, array(self::ACTION_PENDING))) {
                PPMFWC_Helper_Data::ppmfwc_payLogger('Exchange incoming', $order_id, array('action' => $action, 'wc_order_id' => $wc_order_id, 'methodid' => $methodId));

                # Try to update the orderstatus.
                $newStatus = PPMFWC_Helper_Transaction::processTransaction($order_id, $status, $methodId, $params);
                $message = 'TRUE|Status updated to ' . $newStatus;
            }
        } catch (PPMFWC_Exception_Notice $e) {
            $message = 'TRUE|Notice: ' . $e->getMessage();
        } catch (PPMFWC_Exception $e) {
            $message = 'False|Error 1: ' . $e->getMessage();
        } catch (Exception $e) {
            $message = 'False|Error 2: ' . $e->getMessage();
        }
        $suppressed = ob_get_clean();

        if (!empty($suppressed)) {
            $message .= ' |Suppressed Output: ' . $suppressed;
        }
        if ($action == self::ACTION_NEWPPT) {
            PPMFWC_Helper_Transaction::removeProcessing($order_id);
        }
        die($message);
    }

    /**
     * Handles the Pay. feature requests
     * @phpcs:ignore Squiz.Commenting.FunctionComment.MissingReturn
     */
    public static function ppmfwc_onFeatureRequest()
    {
        try {
            global $wp_version;
            global $woocommerce;
            $email = isset($_POST['email']) ? strtolower($_POST['email']) : null;
            $message = isset($_POST['message']) ? nl2br($_POST['message']) : null;
            if (empty($message)) {
                throw new Exception('Empty message');
            }
            $to = 'webshop@pay.nl';
            $subject = 'Feature Request Woocommerce';
            $body = '

                <table role="presentation" style="margin-top:50px; margin-bottom:50px; width:100%;border-collapse:collapse;border:0;border-spacing:0;background:#ffffff;">
                    <tr>
                        <td align="center" style="padding:0;">
                            <table role="presentation" style="width:600px;border-collapse:collapse;border:1px solid #cccccc;border-spacing:0;text-align:left;">
                                <tr>
                                    <td style="padding:25px;">
                                        <h1 style="font-size:24px;margin:0 0 20px 0;font-family:Arial,sans-serif;">Pay. Feature Request</h1>
                                        <p style="margin:0 0 12px 0;font-size:16px;line-height:24px;font-family:Arial,sans-serif;">
                                            A client has sent a feature request via Woocommerce.
            ';
            if ($email) {
                $body .= '
                                            <br>
                                            <br>
                                            <b>Client Email:</b>
                                            <br>
                                            <span style="width: 100%;box-sizing: border-box; display:inline-block; padding: 10px; border:1px solid #cccccc;">' . $email . '</span>
                ';
            }
            $body .= '
                                            <br>
                                            <br>
                                            <b>Message:</b>
                                            <br>
                                            <span style="width: 100%;box-sizing: border-box; display:inline-block; padding: 10px; border:1px solid #cccccc;">' . $message . '</span>
                                            <br>
                                            <br>
                                            Pay. plugin version: ' . PPMFWC_Helper_Data::getVersion() . '.
                                            <br>
                                            Wordpress version: ' . $wp_version . '.
                                            <br>
                                            Woocommerce version: ' . $woocommerce->version . '.
                                            <br>
                                            PHP version: ' . substr(phpversion(), 0, 3) . '.
                                        </p>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>

            ';
            $headers = array('Content-Type: text/html; charset=UTF-8');
            wp_mail($to, $subject, $body, $headers);
            $result = true;
        } catch (Exception $e) {
            $result = false;
        }
        header('Content-Type: application/json;charset=UTF-8');
        $returnarray = array(
            'success' => $result,
            'message' => $message,
        );
        die(json_encode($returnarray));
    }

    /**
     * Handles the Pay. feature requests
     * @phpcs:ignore Squiz.Commenting.FunctionComment.MissingReturn
     */
    public static function ppmfwc_onPinRefund()
    {
        try {
            PPMFWC_Gateway_Abstract::loginSDK();

            $amount = isset($_POST['amount']) ? $_POST['amount'] : null;
            $terminal = isset($_POST['terminal']) ? $_POST['terminal'] : null;
            $returnUrl = isset($_POST['returnUrl']) ? $_POST['returnUrl'] : null;
            $order_id = isset($_POST['order_id']) ? $_POST['order_id'] : null;

            $order = new WC_Order($order_id);

            $exchangeUrl = add_query_arg('wc-api', 'Wc_Pay_Gateway_Exchange', home_url('/'));

            $strAlternativeExchangeUrl = PPMFWC_Gateway_Abstract::getAlternativeExchangeUrl();
            if (!empty(trim($strAlternativeExchangeUrl))) {
                $exchangeUrl = $strAlternativeExchangeUrl;
            }

            $ipAddress = $order->get_customer_ip_address();
            if (empty($ipAddress)) {
                $ipAddress = Paynl\Helper::getIp();
            }

            $currency = $order->get_currency();
            $order_id = $order->get_id();

            $prefix = empty(get_option('paynl_order_description_prefix')) ? '' : get_option('paynl_order_description_prefix');

            $startData = array(
                'amount'        => $amount,
                'returnUrl'     => $returnUrl,
                'exchangeUrl'   => $exchangeUrl,
                'orderNumber'   => $order->get_order_number(),
                'paymentMethod' => PPMFWC_Gateway_Abstract::PAYMENT_METHOD_PINREFUND,
                'bank'          => $terminal,
                'currency'      => $currency,
                'description'   => str_replace('__', ' ', $prefix) . $order->get_order_number(),
                'extra1'        => apply_filters('paynl-extra1', $order->get_order_number(), $order),
                'extra2'        => apply_filters('paynl-extra2', $order->get_billing_email(), $order),
                'extra3'        => apply_filters('paynl-extra3', $order_id, $order),
                'ipaddress'     => $ipAddress,
                'object'        => PPMFWC_Helper_Data::getObject(),
                'bank' => $terminal,
                'currency' => $currency,
                'description' => str_replace('__', ' ', $prefix) . $order->get_order_number(),
                'extra1' => apply_filters('paynl-extra1', $order->get_order_number(), $order),
                'extra2' => apply_filters('paynl-extra2', $order->get_billing_email(), $order),
            );

            $payTransaction = \Paynl\Transaction::start($startData);

            $order->update_meta_data('pinRefundTransactionId', $payTransaction->getTransactionId());
            $order->save();

            PPMFWC_Helper_Transaction::newTransaction($payTransaction->getTransactionId(), PPMFWC_Gateway_Abstract::PAYMENT_METHOD_PINREFUND, $amount, $order_id, '');

            $returnarray = array(
                'success' => true,
                'url' => $payTransaction->getRedirectUrl(),
            );
        } catch (\Exception $e) {
            $returnarray = array(
                'success' => false,
                'message' => $e->getMessage(),
            );
        }

        header('Content-Type: application/json;charset=UTF-8');
        die(json_encode($returnarray));
    }

    /**
     * @phpcs:ignore Squiz.Commenting.FunctionComment.MissingReturn
     */
    public static function ppmfwc_registerCheckoutFlash()
    {
        $paynlstatus = isset($_REQUEST['paynl_status']) ? sanitize_text_field($_REQUEST['paynl_status']) : null;
        if ($paynlstatus == self::STATUS_CANCELED) {
            add_action('woocommerce_before_checkout_form', array(__CLASS__, 'ppmfwc_displayFlashCanceled'), 20);
        }
        if ($paynlstatus == self::STATUS_PENDING) {
            add_action('woocommerce_before_thankyou', array(__CLASS__, 'ppmfwc_displayFlashPending'), 20);
        }
    }

    /**
     * @phpcs:ignore Squiz.Commenting.FunctionComment.MissingReturn
     */
    public static function ppmfwc_displayFlashCanceled()
    {
        wc_print_notice(__('The payment has been cancelled, please try again', PPMFWC_WOOCOMMERCE_TEXTDOMAIN), 'error');
    }

    /**
     * @phpcs:ignore Squiz.Commenting.FunctionComment.MissingReturn
     */
    public static function ppmfwc_displayFlashPending()
    {
        wc_print_notice(__('The payment is pending or not completed', PPMFWC_WOOCOMMERCE_TEXTDOMAIN), 'notice');
    }
}
