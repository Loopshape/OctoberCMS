# OctoMail Plugin

A powerful plugin to create front-end contact forms that allow to send email messages based on custom templates.

## How do this work

An email template plugin for OctoberCMS to help easily embed a contact form or any HTML form what send email on any page of your website. It works using the AJAX Framework, so Javascript and jquery are required. Also, you must configure your email template in the admin area with a working smtp or other basic mail settings first. In other words, your server should be able to send emails for this plugin to work.

### Creating an Email Template

1. Go to OctoMail on the main menus in your backend.

2. Click on the Templates subsection.

3. Create in +New Template.

4. Type the template title as you want, the slug is automatically populated.

5. Type the email template body in the WYSIWYG area on the "Edit" tab. Use twig for the HTML form fields you will recive to populate data on this template.

6. In the "Validation Fields" area, you can validade your form before send it, use the follow syntax to do it:
+ Eg. field_name_one|rule_one|rule_two,field_name_two|rule_one|rule_two,field_name_three|rule_one|rule_two
+ Use "," comma to separate each field and "|" pipe to separate the rules. This validation use the native CMS validation rules.
+ Eg. name|required,email|required|email,subject|required,body|required
+ Remember: first use the field name|second is the rule. You also can use regex to validade a specific field.

7. Select the language of the template.

8. Type the subject will have the email message.

9. The 'Sender Name' and 'Sender Email' are required to the email message head

10. 'Recipient Name' and 'Recipient Email' are optional, if you leave it blank, the plugin will assume the system 'Email Configuration' sender name and sender email as default recipient.

### Usage

After create an email template, you can use the html form in two ways:

### 1. Using the component default markup or html

+ The plugin should display a component on the components tab on the cms main menu.

+ You can include the component like any other component, no customization needed.

+ The component has a default markup as shown below and depends on bootstrap.

**Page: HTML Form**

```
<form role="form"
      data-request="{{__SELF__}}::onOctoMailSent"
      data-request-update="'{{__SELF__}}::confirm': '.confirm-container'"
      data-request-success="$('.form-groups').slideUp(1000)">

    <div class="form-groups">
    <div class="form-group">
        <input type="text" class="form-control" value=""  name="name" placeholder="Enter name">
    </div>
    <div class="form-group">
        <input type="text" class="form-control" value="" name="email" placeholder="Enter Email">
    </div>
    <div class="form-group">
        <input type="text" class="form-control" value=""  name="phone" placeholder="Enter phone">
    </div>
    <div class="form-group">
        <input type="text" class="form-control" value="" name="subject" placeholder="Enter Subject">
    </div>
    <div class="form-group">
        <textarea class="form-control" value="" name="body" placeholder="Enter Message" cols="30" rows="10"></textarea>
    </div>
    <button type="submit" class="btn btn-primary btn-lg pull-right">Send</button>
    </div>

    <div class="confirm-container">
    <!--This will contain the confirmation when the email is successfully sent-->
    </div>
</form>
```

+ You can remove the bootstrap specific classes but then you must style the form using your own custom css in your theme.

**Partial: Confirm Result**

```
{% if result == true %}
    <h4>Email Sent successfully</h4>
    <p>
        {{confirmation_text}}
    </p>
{% endif %}
```


### 2. Using Custom markup or html

If you need to customize the markup for custom styling, donot embed the component as instructed above. Instead, embed the following html anywhere and remove the bootstrap specific classes and add your own. However, you must leave the (data-request, data-request-success and data-request-update) data-attributes intact as they are needed for the ajax to work. Refer to this [doc section](http://octobercms.com/docs/cms/ajax) to know what's happening here in detail.

**Page: HTML Form**

```
<form role="form"
      data-request="onOctoMailSent"
      data-request-update="'confirm': '.confirm-container'"
      data-request-success="$('.form-groups').slideUp(1000)">

    <div class="form-groups">
    <div class="form-group">
        <input type="text" class="form-control" value=""  name="name" placeholder="Enter name">
    </div>
    <div class="form-group">
        <input type="text" class="form-control" value="" name="email" placeholder="Enter Email">
    </div>
    <div class="form-group">
        <input type="text" class="form-control" value=""  name="phone" placeholder="Enter phone">
    </div>
    <div class="form-group">
        <input type="text" class="form-control" value="" name="subject" placeholder="Enter Subject">
    </div>
    <div class="form-group">
        <textarea class="form-control" value="" name="body" placeholder="Enter Message" cols="30" rows="10"></textarea>
    </div>
    <button type="submit" class="btn btn-primary btn-lg pull-right">Send</button>
    </div>

    <div class="confirm-container">
    <!--This will contain the confirmation when the email is successfully sent-->
    </div>
</form>
```

**Partial: Confirm Result**

```
{% if result == true %}
    <h4>Email Sent successfully</h4>
    <p>
        {{confirmation_text}}
    </p>
{% endif %}
```

### **Note**
> Please note that the default markup provided by the form component relies on bootstrap and it's classes for styling. If you rely on it, you must make sure that bootstrap is loaded for it to be properly styled. I encourage you to style it using your own custom css to fit the overall style of your website.