
# Create pricing model

Build the pricing model with Products and Prices. Read the docs to learn more about pricing models.
Add field with the lookup_key of your Price in checkout.html and update the file:
~~~
checkout.html

<input type="hidden" name="lookup_key" value="<< Pricing model ID>>" />
~~~

# Prebuilt Checkout page with subscriptions

Explore a full, working code sample of an integration with Stripe Checkout and Customer Portal. The client- and server-side code redirects to a prebuilt payment page hosted on Stripe. Included are some basic build and run scripts you can use to start up the application.

## Running the sample

1. Build the server

~~~
composer install
~~~

2. Run the server

~~~
php -S 127.0.0.1:5243 -docroot=public
~~~

3. Go to checkout page with subscriptions

~~~
http://localhost:5243/public/checkout.html
~~~

Reference: 
https://stripe.com/docs/billing

Subscriptions dashboard:
https://dashboard.stripe.com/test/subscriptions

All payments:
https://dashboard.stripe.com/test/payments
