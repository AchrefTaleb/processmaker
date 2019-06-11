---
description: Learn what information displays in summaries for Requests with errors.
---

# Summary for Requests with Errors

## Overview

Follow these steps to view a summary for a Request that has an error:

1. Ensure that you are [logged on](../../log-in.md#log-on) to ProcessMaker.
2. View one of the following **Requests** pages:
   * **My Requests** page. See [View Your Requests That You Started](../view-started-requests.md#view-your-requests).
   * **In Progress** page. See [View Requests That Are In Progress](../view-in-progress-requests.md#view-in-progress-requests-in-which-you-are-participating).
   * **Completed** page. See [View Completed Requests](../view-completed-requests.md#view-completed-requests-in-which-you-participated).
   * **All Requests** page. See [View All Requests](../view-all-requests.md#view-all-requests-in-your-organization). \(Note that your ProcessMaker user account must have the [**Requests: View All Requests** permission](../../../processmaker-administration/permission-descriptions-for-users-and-groups.md#requests) to view the **All Requests** page.\)
3. Do one of the following:
   * From the **\#** column in the Request page, click the Request number associated with the Process that you want to view. That Request's summary displays.
   * Click the **Open Request** icon![](../../../.gitbook/assets/open-request-icon-requests.png)for a Request. That Request's summary displays.

## Summary of the Error

The **Errors** tab displays the summary about an error for a selected Request if an error occurred. The **Errors** tab only displays if an error has occurred.

![&quot;Errors&quot; tab displays information about a Request error](../../../.gitbook/assets/error-tab-information-requests.png)

The **Errors** tab displays the following summary in tabular format about Request errors:

* **Error:** The **Error** column displays the error description. 
* **Time:** The **Time** column displays how long ago the error occurred.
* **Element:** The **Element** column displays to which element the error occurred within the Process associated with the Request.

Below the table, the history of the Request displays all Request actions to the time the error occurred. See [Request History](summary-for-requests-with-errors.md#request-history).

## Tasks Assigned to Request Participants

The **Tasks** tab displays the summary for all assigned Tasks to Request participants to the time the error occurred.

~~NEED SCREEN SHOT OF TASK TAB WITH AN ERROR~~

The **Tasks** tab displays the following summary in tabular format about assigned Tasks to Request participants to the time the error occurred:

* **Task:** The **Task** column displays the name of each Task to be completed for the selected Request for all Request participants. If a Task is assigned to you, a hyperlink displays in the Task name.
* **Assigned:** The **Assigned** column displays the username's avatar to whom the Task is assigned. Hover your cursor over a user's avatar to view that person's full name.
* **Due:** The **Due** column displays the date the Task is due. The time zone setting to display the time is according to the ProcessMaker Spark server unless your [user profile's](../../profile-settings.md#change-your-profile-settings) **Time zone** setting is specified.

Below the table, the history of the Request displays all Request actions. See [Request History](summary-for-requests-with-errors.md#request-history).

{% hint style="info" %}
### No Assigned Tasks?

If there are no assigned Tasks for the selected Request, the following message displays: **No Data Available**.

### Display Information the Way You Want It

[Control how tabular information displays](../../control-how-requests-display-in-a-tab.md), including how to sort columns or how many items display per page.
{% endhint %}

## Values in the Request

The **Summary** tab displays the summary of information entered into the Request to the time the error occurred. Request information may be entered in the following ways:

* Request participants manually enter information into ProcessMaker Screens. ProcessMaker Screens are digital forms.
* Authenticated users submit data through the ProcessMaker Spark REST API.

~~NEED SCREEN SHOT OF SUMMARY TAB WITH AN ERROR~~

~~Process Owners can specify how information displays in the **Summary** tab. By default,~~ the **Summary** tab displays the JSON-formatted key/value pairs in tabular format that represent ProcessMaker Screen control data. Information is displayed:

* **KEY:** The **KEY** column displays the JSON key name that represents the ProcessMaker Screen control name the Request participant entered data or specified through the ProcessMaker Spark REST API. For example, a Text control to enter your name could be named `Full Name` which would display in the **Key** column here.
* **VALUE:** The **VALUE** column displays that key's value as entered by a person manually interacting with a form or specified through the ProcessMaker Spark REST API. For example, a Text control to enter your name could have the value `John Doe` which would display in the **Value** column here.

Below the table, the history of the Request displays all Request actions. See [Request History](summary-for-requests-with-errors.md#request-history).

{% hint style="info" %}
[Control how tabular information displays](../../control-how-requests-display-in-a-tab.md), including how to sort columns or how many items display per page.
{% endhint %}

## Completed Tasks Summary

The **Completed** tab displays the summary of all Tasks Request participants completed to the time the Request error occurred.

~~NEED SCREEN SHOT OF COMPLETED TAB WITH AN ERROR~~

The **Completed** tab displays the following summary in tabular format about completed Tasks Request participants completed to the time the Request error occurred:

* **Task:** The **Task** column displays the name of each completed Task in the selected Request. 
* **Assigned:** The **Assigned** column displays the username's avatar to whom the Task was assigned. Hover your cursor over a user's avatar to view that person's full name.
* **Due:** The **Due** column displays the date the Task was due. The time zone setting to display the time is according to the ProcessMaker Spark server unless your [user profile's](../../profile-settings.md#change-your-profile-settings) **Time zone** setting is specified.

Below the table, the history of the Request displays all Request actions. See [Request History](summary-for-requests-with-errors.md#request-history).

{% hint style="info" %}
### There Are No Completed Tasks?

If the selected Request has no completed Tasks, the following message displays: **No Data Available**.

### Display Information the Way You Want It

[Control how tabular information displays](../../control-how-requests-display-in-a-tab.md), including how to sort columns or how many items display per page.
{% endhint %}

## Files Associated with the Request

The **Files** tab displays the summary of all files associated with the Request error occurred. The **Files** tab only displays if at least one file has been uploaded to the Request. The name of each file is linked to the file so you can download that file to your local computer or network location.

~~NEED A SCREEN SHOT OF THE FILES TAB WITH AN ERROR~~

The **Files** tab displays the following summary in tabular format about the files associated with the Request:

* **File Name:** The **File Name** column displays the name of each associated with the selected Request. Click the file name to download it to your local computer or network location. 
* **MIME Type:** The **MIME Type** column displays the MIME type for the associated file.
* **Created At:** The **Created At** column displays the date the file became associated with the selected Request. The file became associated with the Request when the person who attached it submitted the [ProcessMaker Screen](../../../designing-processes/design-forms/what-is-a-form.md) to which the file was uploaded. The time zone setting to display the time is according to the ProcessMaker Spark server unless your [user profile's](../../profile-settings.md#change-your-profile-settings) **Time zone** setting is specified.

Below the table, the history of the Request displays all Request actions to the time the Request error occurred. See [Request History](summary-for-requests-with-errors.md#request-history).

## Request Participants

Each Request that has an error displays a summary of the Request participants to the time of the error.

![Request participant summary for a Request in which an error occurred](../../../.gitbook/assets/error-request-information-requests.png)

The following summary displays about participants in a Request in which an error occurred:

* **Requested By:** The **Requested By** field displays the avatar and full name of the person who started the selected Request. Hover your cursor over a user's avatar to view that person's full name.
* **Participants:** The **Participants** displays each Request participant's avatar in the selected Request to the time of the error. Hover your cursor over a user's avatar to view that person's full name.
* **Request error date:** The date and time in which the Request error occurred displays below the **Participants** field. The time zone setting to display the time is according to the ProcessMaker Spark server unless your [user profile's](../../profile-settings.md#change-your-profile-settings) **Time zone** setting is specified.

## Request History

Below the tabular information summarizing the Request displays that Request's history: all Request actions to that time. The oldest Request actions display at the top of the Request history.

![Request history displays all actions in a Request, with the oldest actions at the top](../../../.gitbook/assets/request-history-requests.png)

The following information displays about each event in the Request history:

* **Request participant:** The Request participant who performed the action is represented by his or her avatar. Hover your cursor over a user's avatar to view that person's full name. If the ProcessMaker system performed an action by running a ProcessMaker Script or other automatic function, that action is represented by "S" avatar.
* **Date and time the action occurred:** To the right of the Request participant displays the date and time the Request action occurred. The time zone setting to display the time is according to the ProcessMaker Spark server unless your [user profile's](../../profile-settings.md#change-your-profile-settings) **Time zone** setting is specified.
* **Description of the action:** To the right of when the Request action occurred displays a description of that action. The ProcessMaker system generates this action description.

## Related Topics

{% page-ref page="../what-is-a-request.md" %}

{% page-ref page="../view-started-requests.md" %}

{% page-ref page="../view-in-progress-requests.md" %}

{% page-ref page="../view-completed-requests.md" %}

{% page-ref page="../view-all-requests.md" %}

{% page-ref page="summary-for-in-progress-requests.md" %}

{% page-ref page="summary-for-completed-requests.md" %}

{% page-ref page="summary-for-canceled-requests.md" %}

{% page-ref page="../../../designing-processes/design-forms/what-is-a-form.md" %}

