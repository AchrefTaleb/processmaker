---
description: Manage computed Properties for a ProcessMaker Screen's JSON data model.
---

# Manage Computed Properties

## Overview

Use Computed Properties mode to add Properties to a [ProcessMaker Screen's](../what-is-a-form.md) JSON data model. A Property represents any value, mathematical calculation, or formula that calculates a value. A Property's computation can be determined either through a mathematical formula or valid JavaScript, and may include [ProcessMaker Screen control](control-descriptions/) values during a [Request](../../../using-processmaker/requests/what-is-a-request.md). Likewise, a computed Property's value can be displayed in a ProcessMaker Screen control. Computed Properties can only be used within and only affect the currently opened ProcessMaker Screen.

Below are a few uses for computed Properties that can be calculated mathematically or through JavaScript:

* Perform simple mathematics. Example: `1+1`
* Calculate the final cost of a purchase based on a sales tax. Example: $`60` \(item cost\) x `.075` \(sales tax\)
* Calculate the minimum credit card payment. Example: $`1000` \(amount owed\) x `.03` \(interest rate\)

Computed Properties display as the second key-value pair in the ProcessMaker Screen's JSON data model from the [**Data Preview** section of the **Inspector** panel when previewing the Screen](preview-a-screen.md).

## Add a Computed Property

{% hint style="info" %}
Your user account or group membership must have the following permissions to add a computed Property to a ProcessMaker Screen:

* Screens: View Screens
* Screens: Edit Screens

See the ProcessMaker [Screens](../../../processmaker-administration/permission-descriptions-for-users-and-groups.md#screens) permissions or ask your ProcessMaker Administrator for assistance.
{% endhint %}

Follow these steps to add a calculated Property:

1. [Open](../manage-forms/view-all-forms.md) the ProcessMaker Screen in which to add a computed Property. The ProcessMaker Screen is in [Design mode](screens-builder-modes.md#editor-mode).
2. Click the **Computed Properties** button![](../../../.gitbook/assets/computed-properties-button-screens-builder-processes.png). The **Computed Properties** screen displays all Properties configured for this ProcessMaker Screen. All Properties configured in this screen display their computed values in the JSON data model from the [**Data Preview** section of the **Inspector** panel when previewing the ProcessMaker Screen](preview-a-screen.md). If no Properties have been configured for this ProcessMaker Screen, **Property Name** displays as a placeholder for the first Property.  

   ![](../../../.gitbook/assets/computed-properties-screen-screens-builder-processes.png)

3. Click the **+Add Property** button. The **Computed Properties** screen displays fields to configure a Property.  

   ![](../../../.gitbook/assets/computed-properties-definition-screen-screens-builder-processes.png)

4. In the **Property Name** field, enter the name of the Property. This Property name displays both in the **Computed Properties** screen and in the JSON data model when previewing the ProcessMaker Screen. This is a required field.
5. In the **Description** field, enter the description of the Property. This is a required field.
6. Above the **Formula** field, select one of the following ways to compute the Property:
   * **Mathematical calculation:** Click the **Formula** icon![](../../../.gitbook/assets/formula-icon-computed-property-screens-builder-processes.png)to enter the value, mathematical calculation, or formula that computes the Property. The **Formula** icon is selected by default.
   * **JavaScript:** Click the **JavaScript** icon![](../../../.gitbook/assets/javascript-icon-computed-property-screens-builder-processes.png)to compute the Property using valid JavaScript. By computing the Property using JavaScript, you can reference the values for ProcessMaker Screen controls and ProcessMaker [Global Variables](../../reference-global-variables-in-your-processmaker-assets.md). Ensure to use valid JavaScript to compute the Property by using a `return` statement to return the result of an expression \(the value\). Furthermore, ensure to use `this.` preceding the ProcessMaker Screen/Global Variable reference. Example: `return this.FullName`. Follow these guidelines for each:
     * **Screen control value:** Reference a ProcessMaker Screen control's value by referencing that control's **Variable Value** setting. Example: `return  this.FullName` when `FullName` is the **Variable Value** setting.
     * **Global Variable value:** Reference a ProcessMaker Global Variable's value. ProcessMaker uses a set of Global Variables that become part of the JSON data model for all Requests. ProcessMaker uses these Global Variables to store ProcessMaker user, Process, and Request related data for all Requests. During an in-progress Request, these ProcessMaker Global Variables are updated. All ProcessMaker Global Variables are preceded by an underscore \(`_`\) character in the JSON data model. Reference the ProcessMaker Global Variable after `this.`. Example: `return  this._user.fullname` when you want to reference the ProcessMaker user's full name from the in-progress Request. See [Global Variable Descriptions](../../reference-global-variables-in-your-processmaker-assets.md#global-variable-descriptions). Note that there is no ProcessMaker Global Variable that stores the ProcessMaker user that starts a Request \(also known as the requester\). To address this, use a computed Property to reference the `_user.fullname` Global Variable's value in the ProcessMaker Screen referenced in the first Task element of a Process; since many Processes are designed such that the requester is the ProcessMaker user assigned the first Task in a Request, this is a helpful way of storing  who the requester is. This computed Property stores this Global Variable's value, which you may reference elsewhere.
7. In the **Formula** field, enter the mathematical calculation/JavaScript that computes the Property. This is a required field.
8. Click **Save Property**. The Property displays in the **Computed Properties** screen. The following message displays: **Property Saved**.

![Computed Properties screen with a new Property](../../../.gitbook/assets/computed-properties-screen-with-property-screens-builder-processes.png)

## View a Computed Property's Details

{% hint style="info" %}
Your user account or group membership must have the following permissions to view a computed Property's details:

* Screens: View Screens
* Screens: Edit Screens

See the ProcessMaker [Screens](../../../processmaker-administration/permission-descriptions-for-users-and-groups.md#screens) permissions or ask your ProcessMaker Administrator for assistance.
{% endhint %}

Follow these steps to view a computed Property:

1. [Open](../manage-forms/view-all-forms.md) the ProcessMaker Screen in which to add a computed Property. The ProcessMaker Screen is in [Design mode](screens-builder-modes.md#editor-mode).
2. [Open the **Computed Properties** screen.](manage-computed-properties.md#add-a-computed-property)
3. Click the **Details** icon![](../../../.gitbook/assets/computed-properties-details-icon-screens-builder-processes.png). The **Computed Properties** screen displays how the selected Property is named and computed.  

   ![](../../../.gitbook/assets/computed-properties-details-screen-screens-builder-processes.png)

4. Click the **Hide Details** button to hide the Property's details.

## Edit a Computed Property

{% hint style="info" %}
Your user account or group membership must have the following permissions to edit a computed Property:

* Screens: View Screens
* Screens: Edit Screens

See the ProcessMaker [Screens](../../../processmaker-administration/permission-descriptions-for-users-and-groups.md#screens) permissions or ask your ProcessMaker Administrator for assistance.
{% endhint %}

Follow these steps to edit a computed Property:

1. [Open](../manage-forms/view-all-forms.md) the ProcessMaker Screen in which to add a computed Property. The ProcessMaker Screen is in [Design mode](screens-builder-modes.md#editor-mode).
2. [Open the **Computed Properties** screen.](manage-computed-properties.md#add-a-computed-property)
3. Click the **Edit** icon![](../../../.gitbook/assets/computed-properties-edit-icon-screens-builder-processes.png). The **Computed Properties** screen displays how the selected Property is named and computed.  

   ![](../../../.gitbook/assets/computed-property-screen-edit-screens-builder-processes.png)

4. Edit the following information about the Property as necessary:
   * In the **Property Name** field, enter the name of the Property. This Property name displays both in the **Computer Properties** screen and in the JSON data model when previewing the ProcessMaker Screen. This is a required field.
   * In the **Description** field, enter the description of the Property. This is a required field.
   * Above the **Formula** field, select one of the following ways to compute the Property:
     * **Mathematical calculation:** Click the **Formula** icon![](../../../.gitbook/assets/formula-icon-computed-property-screens-builder-processes.png)to enter the value, mathematical calculation, or formula that computes the Property. The **Formula** icon is selected by default.
     * **JavaScript:** Click the **JavaScript** icon![](../../../.gitbook/assets/javascript-icon-computed-property-screens-builder-processes.png)to compute the Property using valid JavaScript. To reference a ProcessMaker Screen control's value in JavaScript, reference that control's **Variable Value** setting after `this.`. Example: `this.FullName`.
   * In the **Formula** field, enter the computed Property. This is a required field.
5. Click **Save Property**.

## Delete a Computed Property

{% hint style="info" %}
Your user account or group membership must have the following permissions to delete a computed Property from a ProcessMaker Screen:

* Screens: View Screens
* Screens: Edit Screens

See the ProcessMaker [Screens](../../../processmaker-administration/permission-descriptions-for-users-and-groups.md#screens) permissions or ask your ProcessMaker Administrator for assistance.
{% endhint %}

Follow these steps to delete a computed Property:

1. [Open](../manage-forms/view-all-forms.md) the ProcessMaker Screen in which to delete a computed Property. The ProcessMaker Screen is in [Design mode](screens-builder-modes.md#editor-mode).
2. [Open the **Computed Properties** screen.](manage-computed-properties.md#add-a-computed-property)
3. Click the **Delete** icon![](../../../.gitbook/assets/computed-property-delete-icon-screens-builder-processes.png). The Property is deleted, and the following message displays: **Property deleted**.

## Related Topics

{% page-ref page="what-is-screens-builder.md" %}

{% page-ref page="preview-a-screen.md" %}

{% page-ref page="control-descriptions/" %}

{% page-ref page="../manage-forms/view-all-forms.md" %}

{% page-ref page="types-for-screens.md" %}

{% page-ref page="screens-builder-modes.md" %}

{% page-ref page="validate-your-screen.md" %}

{% page-ref page="add-a-new-page-to-a-screen.md" %}

{% page-ref page="manage-computed-properties.md" %}

{% page-ref page="add-custom-css-to-a-screen.md" %}

{% page-ref page="save-a-screen.md" %}

{% page-ref page="best-practices.md" %}

{% page-ref page="../../../using-processmaker/requests/what-is-a-request.md" %}

