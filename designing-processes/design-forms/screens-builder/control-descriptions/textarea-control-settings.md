---
description: >-
  Add a Textarea control from which the user can insert more than three lines of
  text.
---

# Textarea Control Settings

## Control Description

Though this control displays a vertical scroll bar if more than three lines are inserted, the input box can be expanded as necessary. To do this, click the lower right-hand corner of the input box of the Textarea control, hold, and then drag to enlarge or shrink the control size as necessary. Release when you have adjusted the input box to your required size.

{% hint style="info" %}
This control is not available for [Display](../types-for-screens.md#display)-type ProcessMaker Screens. See [Screen Types](../types-for-screens.md).
{% endhint %}

## Add the Control to a ProcessMaker Screen <a id="add-the-control-to-a-processmaker-screen"></a>

{% hint style="info" %}
Your user account or group membership must have the following permissions to add a control to a ProcessMaker Screen:

* Screens: View Screens
* Screens: Edit Screens

See the ProcessMaker [Screens](../../../../processmaker-administration/permission-descriptions-for-users-and-groups.md#screens) permissions or ask your ProcessMaker Administrator for assistance.
{% endhint %}

Follow these steps to add this control to the ProcessMaker Screen:

1. [Create](../../manage-forms/create-a-new-form.md) or [open](../../manage-forms/view-all-forms.md) the ProcessMaker Screen. The ProcessMaker Screen is in [Design mode](../screens-builder-modes.md#editor-mode).
2. View the ProcessMaker Screen page to which to add the control.
3. Go to the **Controls** panel on the left side of the ProcessMaker Screen.
4. Drag the **Textarea** icon![](../../../../.gitbook/assets/textarea-control-screens-builder-processes.png)from the **Controls** panel anywhere within the ProcessMaker Screen canvas. Existing controls on the ProcessMaker Screen canvas adjust positioning based on where you drag the control.
5. Place into the ProcessMaker Screen canvas where you want the control to display on the page.

   ![](../../../../.gitbook/assets/textarea-control-placed-screens-builder-processes.png)

6. Configure the Textarea control. See [Inspector Settings](textarea-control-settings.md#inspector-settings).

Below is a Textarea control in Preview mode.

![Textarea control in Preview mode](../../../../.gitbook/assets/textarea-control-placed-screens-builder-processes%20%281%29.png)

## Delete the Control from a ProcessMaker Screen

{% hint style="warning" %}
Deleting a control also deletes configuration for that control. If you add another control, it will have default settings.
{% endhint %}

Click the **Delete** icon![](../../../../.gitbook/assets/delete-screen-control-screens-builder-processes.png)for the control to delete it.

## Inspector Settings <a id="inspector-settings"></a>

{% hint style="info" %}
### Don't Know What the Inspector Panel Is?

See [View the Inspector Panel](../view-the-inspector-pane.md).

### Permissions Required

Your user account or group membership must have the following permissions to edit a ProcessMaker Screen control:

* Screens: View Screens
* Screens: Edit Screens

See the ProcessMaker [Screens](../../../../processmaker-administration/permission-descriptions-for-users-and-groups.md#screens) permissions or ask your ProcessMaker Administrator for assistance.
{% endhint %}

Below are Inspector settings for the Textarea control:

* **Variable Name:** Enter a unique name that represents this control's value. Use the **Variable Name** value in the following ways:

  * Reference this control by its **Variable Name** setting's value.
  * Reference this control's value in a different Screens Builder control. To do so, use mustache syntax and reference this control's **Variable Name** value in the target control. Example: `My full name is {{FullName}}`.
  * Reference this value to in [**Visibility Rule** setting expressions](expression-syntax-components-for-show-if-control-settings.md).

  This is a required setting.

* **Field Label:** Enter the field label text that displays. **New TextArea** is the default value.
* **Validation:** Enter the validation rules the form user must comply with to properly enter a valid value into this field. This setting has no default value. See [Validation Rules for "Validation" Control Settings](validation-rules-for-validation-control-settings.md).
* **Rows:** The number of rows to provide for input. **2** is the default value.
* **Placeholder:** Enter the placeholder text that displays in the field when no value has been provided. This setting has no default value.
* **Help Text:** Enter text that provides additional guidance on the field's use. This setting has no default value.
* **Element Background Color:** Select to specify the background color of this control.
* **Text Color:** Select to specify the text color that displays in this control.
* **Visibility Rule:** Enter an expression that dictates the condition\(s\) under which this control displays. See [Expression Syntax Components for "Visibility Rule" Control Settings](expression-syntax-components-for-show-if-control-settings.md#expression-syntax-components-for-show-if-control-settings). If this setting does not have an expression, then this control displays by default.
* **CSS Selector Name:** Enter the value to represent this control in custom CSS syntax when in [Custom CSS](../add-custom-css-to-a-screen.md#add-custom-css-to-a-processmaker-screen) mode. As a best practice, use the same **CSS Selector Name** value on different controls to have the same custom CSS applied.

## Related Topics <a id="related-topics"></a>

{% page-ref page="../types-for-screens.md" %}

{% page-ref page="../view-the-inspector-pane.md" %}

{% page-ref page="./" %}

{% page-ref page="rich-text-control-settings.md" %}

{% page-ref page="text-control-settings.md" %}

{% page-ref page="line-input-control-settings.md" %}

{% page-ref page="select-control-settings.md" %}

{% page-ref page="radio-group-control-settings.md" %}

{% page-ref page="checkbox-control-settings.md" %}

{% page-ref page="date-picker-control-settings.md" %}

{% page-ref page="submit-button-control-settings.md" %}

{% page-ref page="page-navigation-button-control-settings.md" %}

{% page-ref page="multi-column-button-control-settings.md" %}

{% page-ref page="record-list-control-settings.md" %}

{% page-ref page="image-control-settings.md" %}

{% page-ref page="file-upload-control-settings.md" %}

{% page-ref page="file-download-control-settings.md" %}

{% page-ref page="expression-syntax-components-for-show-if-control-settings.md" %}

