## Disposable Email Blocker

This plugin gives you the ability to leverage the block-disposable-email.com's API to prevent users from registering using disposable/throwaway email addresses.

## Requirements

To use this plugin you need to do the following:

    -   Have the Rainlab.User plugin installed
    -   Sign up for an account at www.block-disposable-email.com and get your API key
    -   Configure backend settings: API key, notification email address, enable/disable options
    -   Configure the notification email template on the backend
    -   Add the component to your registration page where an onRegister() method is used
    -   Have a {% flash %} section somewhere in your template for displaying messages

## Things to know

I am in no way affiliated with block-disposable-email.com, however after testing a number of services available I found it to be the easiest to work with and they provide you with 200 free lookups a month.  If you need more lookups than that, refer to their site for pricing.


## What happens after 200 lookups?

The Plugin will notify the email address used in the backend settings that you are out of credits.  You can either choose to purchase more credits or you can temporarily disable the plugin until your counter has reset.

If you do not disable the plugin, all further requests until more credits have been added will automatically pass verification.  You will also continue to get emails informing you of the fact you are out of credits.

To prevent this, simply turn off the 'Receive Notification Emails' checkbox in the settings.
