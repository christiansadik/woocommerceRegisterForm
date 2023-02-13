const select_role = document.getElementById('reg_role');
const form_customer = document.getElementById('form-customer');
const form_address = document.getElementById('form-address');
const form_business = document.getElementById('form-business');
const form_acceptance = document.getElementById('acceptance');
const form_activity = document.getElementById('type-activity');
let activity_options = document.getElementById('reg_type_activity').options;


select_role.addEventListener('change', () => {
    let role = select_role.value;
    let inputs_customer = form_customer.querySelectorAll('input');
    let inputs_business = form_business.querySelectorAll('input');



    let business_activity = ['agent', 'camping', 'water_center', 'agent', 'camping', 'water_park', 'public_administration', 'rehabilitation_center', 'fitness_with_pool',
        'fitness_without_pool', 'sportiv_center', 'builder', 'distributor', 'sports_federation', 'hotel', 'water_park',
        'resort', 'dealer', 'service_company', 'sports_club', 'beach_resort', 'thermal_baths', 'tourist_resort'];
    let customer_activity = ['coach', 'private'];

    switch (role) {
        case 'sales_man':
        case 'company':
        case 'distributor':
        case 'dealer':

            form_business.style.display = 'block';
            form_address.style.display = 'block';

            form_activity.style.display = 'block';
            form_customer.style.display = 'none';
            inputs_customer.forEach(input => {
                inputs_customer.value = '';
            });

            activity_options.selectedIndex = 0
            for (let i = 0; i < activity_options.length; i++) {
                if (customer_activity.includes(activity_options[i].value)) {
                    activity_options[i].setAttribute('hidden', 'true');
                } else {
                    activity_options[i].removeAttribute('hidden');
                }
            };
            break;

        case 'customer':

            form_activity.style.display = 'block';
            form_customer.style.display = 'block';

            form_address.style.display = 'none';
            form_business.style.display = 'none';
            inputs_business.forEach(input => {
                inputs_business.value = '';
            });

            activity_options.selectedIndex = 0
            for (let i = 0; i < activity_options.length; i++) {
                if (business_activity.includes(activity_options[i].value)) {
                    activity_options[i].setAttribute('hidden', 'true');
                } else {
                    activity_options[i].removeAttribute('hidden');
                }
            };
            break;

        default:
            form_business.style.display = 'none';
            inputs_business.forEach(input => {
                inputs_business.value = '';
            });

            form_customer.style.display = 'none';
            inputs_customer.forEach(input => {
                inputs_customer.value = '';
            });

            form_address.style.display = 'none';
            form_activity.style.display = 'none';
            activity_options.selectedIndex = 0
            break;
    }
})