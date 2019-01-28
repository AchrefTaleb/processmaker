---
description: >-
  Add a Checkbox control from which the form user can select or deselect an
  option. Multiple Checkbox controls can be grouped together.
---

# Checkbox Control Settings

## Control Description

The Checkbox control adds a checkbox from which the form user can select or deselect an option. Multiple Checkbox controls can be grouped together.

{% hint style="info" %}
This control is not available for [Display](../types-for-screens.md#display)-type ProcessMaker Screens. See [Screen Types](../types-for-screens.md).
{% endhint %}

## Add the Control to a ProcessMaker Screen

Follow these steps to add this control to the ProcessMaker Screen:

1. View the ProcessMaker Screen page to which to add the control.
2. Go to the **Controls** panel on the left side of the ProcessMaker Screen.
3. Drag the **Checkbox** icon ![](../../../../.gitbook/assets/checkbox-control-screens-builder-processes.png) from the **Controls** panel anywhere within the ProcessMaker Screen canvas represented by the dotted-lined box. Existing controls on the ProcessMaker Screen canvas adjust positioning based on where you drag the control.
4. Drop into the ProcessMaker Screen where you want the control to display on the page.  

   ![](../../../../.gitbook/assets/checkbox-control-placed-screens-builder-processes.png)

Below are two Checkbox controls in Preview mode.

![Checkbox control in Preview mode](../../../../.gitbook/assets/checkbox-control-preview-screens-builder-processes.png)

## Inspector Settings <a id="inspector-settings"></a>

{% hint style="info" %}
See [View the Inspector Panel](../view-the-inspector-pane.md) for information how to view the **Inspector** panel.
{% endhint %}

Below are Inspector settings for the Radio Group control:

* **Field Name:** Specify the internal data name of the control that only the Process Owner views at design time. Use the same **Field Name** value in multiple Checkbox controls to group Checkbox controls with the same **Field Name** value together such that when one in the group is selected, all others are automatically deselected. ~~This is a required setting.~~
* **Field Label:** Specify the field label text that displays. Set by default as **New Checkbox**.
* **Help Text:** Specify text that provides additional guidance on the field's use.
* **Initially Checked?:** Select to indicate that the Checkbox control should be checked \(selected\) by default. Otherwise, deselect to indicate that the Checkbox control is not checked. The default setting is unchecked.

## Related Topics <a id="related-topics"></a>

{% page-ref page="../types-for-screens.md" %}

{% page-ref page="../view-the-inspector-pane.md" %}

{% page-ref page="./" %}

