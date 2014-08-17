<?php
/**
 * AbstractWhatsAppDaemonEventListener
 * @author Christiaan Baartse <anotherhero@gmail.com>
 */
abstract class AbstractWhatsAppDaemonEventListener implements WhatsAppEventListener
{
    /**
     * @var resource
     */
    private $output;

    /**
     * @param resource $output stream
     */
    public function __construct($output)
    {
        $this->output = $output;
    }

    protected function outputEvent($name, array $data)
    {
        fwrite($this->output, json_encode(array('name' => $name, 'data' => $data)));
    }



    function onCodeRegister(
        $phone, // The user phone number including the country code.
        $login, // Phone number with country code.
        $pw, // Account password.
        $type, //, // Type of account.
        $expiration, //Expiration date in UNIX TimeStamp.
        $kind, // Kind of account.
        $price, // Formated price of account.
        $cost, // Decimal amount of account.
        $currency, // Currency price of account.
        $price_expiration // Price expiration in UNIX TimeStamp.
    )
    {
        // TODO: Implement onCodeRegister() method.
    }

    function onCodeRegisterFailed(
        $phone, // The user phone number including the country code.
        $status, // The server status number
        $reason,
        // Reason of the status (e.g. too_recent/missing_param/bad_param).
        $retry_after
        // Waiting time before requesting a new code in seconds.
    )
    {
        // TODO: Implement onCodeRegisterFailed() method.
    }

    function onCodeRequest(
        $phone, // The user phone number including the country code.
        $method, // Used method (SMS/voice).
        $length
        // Registration code length.
    )
    {
        // TODO: Implement onCodeRequest() method.
    }

    function onCodeRequestFailed(
        $phone, // The user phone number including the country code.
        $method, // Used method (SMS/voice).
        $reason,
        // Reason of the status (e.g. too_recent/missing_param/bad_param).
        $value
        // The missing_param/bad_param or waiting time before requesting a new code.
    )
    {
        // TODO: Implement onCodeRequestFailed() method.
    }

    function onCodeRequestFailedTooRecent(
        $phone, // The user phone number including the country code.
        $method, // Used method (SMS/voice).
        $reason, // Reason of the status (too_recent).
        $retry_after // Waiting time before requesting a new code in seconds.
    )
    {
        // TODO: Implement onCodeRequestFailedTooRecent() method.
    }

    function onConnect(
        $phone, // The user phone number including the country code.
        $socket // The resource socket id.
    )
    {
        // TODO: Implement onConnect() method.
    }

    function onConnectError(
        $phone, // The user phone number including the country code.
        $socket // The resource socket id.
    )
    {
        // TODO: Implement onConnectError() method.
    }

    function onCredentialsBad(
        $phone, // The user phone number including the country code.
        $status, // Account status.
        $reason // The reason.
    )
    {
        // TODO: Implement onCredentialsBad() method.
    }

    function onCredentialsGood(
        $phone, // The user phone number including the country code.
        $login, // Phone number with country code.
        $pw, // Account password.
        $type, // Type of account.
        $expiration, // Expiration date in UNIX TimeStamp.
        $kind, // Kind of account.
        $price, // Formated price of account.
        $cost, // Decimal amount of account.
        $currency, // Currency price of account.
        $price_expiration // Price expiration in UNIX TimeStamp.
    )
    {
        // TODO: Implement onCredentialsGood() method.
    }

    function onDisconnect(
        $phone, // The user phone number including the country code.
        $socket // The resource socket id.
    )
    {
        // TODO: Implement onDisconnect() method.
    }

    function onDissectPhone(
        $phone, // The user phone number including the country code.
        $country, // The detected country name.
        $cc, // The number's country code.
        $mcc, // International cell network code for the detected country.
        $lc, // Location code for the detected country
        $lg // Language code for the detected country
    )
    {
        // TODO: Implement onDissectPhone() method.
    }

    function onDissectPhoneFailed(
        $phone // The user phone number including the country code.
    )
    {
        // TODO: Implement onDissectPhoneFailed() method.
    }

    function onGetAudio(
        $phone, // The user phone number including the country code.
        $from, // The sender phone number.
        $msgid, // The message id.
        $type, // The message type.
        $time, // The unix time when send message notification.
        $name, // The sender name.
        $size, // The image size.
        $url, // The url to bigger audio version.
        $file, // The audio name.
        $mimetype, // The audio mime type.
        $filehash, // The audio file hash.
        $duration, // The audio duration.
        $acodec // The audio codec.
    )
    {
        // TODO: Implement onGetAudio() method.
    }

    function onGetError(
        $phone, // The user phone number including the country code.
        $id, // The id of the request that caused the error
        $error // Array with error data for why request failed.
    )
    {
        // TODO: Implement onGetError() method.
    }

    function onGetGroups(
        $phone, // The user phone number including the country code.
        $groupList // Array with all the groups and groupsinfo.
    )
    {
        // TODO: Implement onGetGroups() method.
    }

    function onGetGroupsInfo(
        $phone, // The user phone number including the country code.
        $groupList // Array with the the groupinfo.
    )
    {
        // TODO: Implement onGetGroupsInfo() method.
    }

    function onGetGroupsSubject(
        $phone, // The user phone number including the country code.
        $gId, // The group JID.
        $time, // The unix time when send subject.
        $author, // The author phone number including the country code.
        $participant,
        // The participant phone number including the country code.
        $name, // The sender name.
        $subject // The subject (e.g. group name).
    )
    {
        // TODO: Implement onGetGroupsSubject() method.
    }

    function onGetImage(
        $phone, // The user phone number including the country code.
        $from, // The sender JID.
        $msgid, // The message id.
        $type, // The message type.
        $time, // The unix time when send message notification.
        $name, // The sender name.
        $size, // The image size.
        $url, // The url to bigger image version.
        $file, // The image name.
        $mimetype, // The image mime type.
        $filehash, // The image file hash.
        $width, // The image width.
        $height, // The image height.
        $thumbnail // The base64_encode image thumbnail.
    )
    {
        // TODO: Implement onGetImage() method.
    }

    function onGetLocation(
        $phone, // The user phone number including the country code.
        $from, // The sender JID.
        $msgid, // The message id.
        $type, // The message type.
        $time, // The unix time when send message notification.
        $name, // The sender name.
        $place_name, // The place name.
        $longitude, // The location longitude.
        $latitude, // The location latitude.
        $url, // The place url.
        $thumbnail // The base64_encode location image thumbnail.
    )
    {
        // TODO: Implement onGetLocation() method.
    }

    function onGetMessage(
        $phone, // The user phone number including the country code.
        $from, // The sender JID.
        $msgid, // The message id.
        $type, // The message type.
        $time, // The unix time when send message notification.
        $name, // The sender name.
        $message // The message.
    )
    {
        // TODO: Implement onGetMessage() method.
    }

    function onGetGroupMessage(
        $phone, // The user phone number including the country code.
        $from, // The group JID.
        $author, // The sender JID.
        $msgid, // The message id.
        $type, // The message type.
        $time, // The unix time when send message notification.
        $name, // The sender name.
        $message // The message.
    )
    {
        // TODO: Implement onGetGroupMessage() method.
    }

    function onGetGroupParticipants(
        $phone,
        $groupId,
        $groupList
    ) {
        // TODO: Implement onGetGroupParticipants() method.
    }

    function onGetPrivacyBlockedList(
        $phone, // The user phone number including the country code.
        $children
        /*
        $data, // Array of data nodes containing numbers you have blocked.
        $onGetProfilePicture, //
        $phone, // The user phone number including the country code.
        $from, // The sender JID.
        $type, // The type of picture (image/preview).
        $thumbnail // The base64_encoded image.
        */
    )
    {
        // TODO: Implement onGetPrivacyBlockedList() method.
    }

    function onGetProfilePicture(
        $phone, // The user phone number including the country code.
        $from, // The sender JID.
        $type, // The type of picture (image/preview).
        $thumbnail
        // The base64_encoded image.
    )
    {
        // TODO: Implement onGetProfilePicture() method.
    }

    function onGetRequestLastSeen(
        $phone, // The user phone number including the country code.
        $from, // The sender JID.
        $msgid, // The message id.
        $sec // The number of seconds since the user went offline.
    )
    {
        // TODO: Implement onGetRequestLastSeen() method.
    }

    function onGetServerProperties(
        $phone, // The user phone number including the country code.
        $version, // The version number on the server.
        $properties // Array of server properties.
    )
    {
        // TODO: Implement onGetServerProperties() method.
    }

    function onGetStatus(
        $phone,
        $from,
        $type,
        $id,
        $t,
        $status
    ) {
        // TODO: Implement onGetStatus() method.
    }

    function onGetvCard(
        $phone, // The user phone number including the country code.
        $from, // The sender JID.
        $msgid, // The message id.
        $type, // The message type.
        $time, // The unix time when send message notification.
        $name, // The sender name.
        $contact, // The vCard contact name.
        $vcard // The vCard.
    )
    {
        // TODO: Implement onGetvCard() method.
    }

    function onGetVideo(
        $phone, // The user phone number including the country code.
        $from, // The sender JID.
        $msgid, // The message id.
        $type, // The message type.
        $time, // The unix time when send message notification.
        $name, // The sender name.
        $url, // The url to bigger video version.
        $file, // The video name.
        $size, // The video size.
        $mimetype, // The video mime type.
        $filehash, // The video file hash.
        $duration, // The video duration.
        $vcodec, // The video codec.
        $acodec, // The audio codec.
        $thumbnail // The base64_encode video thumbnail.
    )
    {
        // TODO: Implement onGetVideo() method.
    }

    function onGroupsChatCreate(
        $phone, // The user phone number including the country code.
        $gId // The group JID.
    )
    {
        // TODO: Implement onGroupsChatCreate() method.
    }

    function onGroupsChatEnd(
        $phone, // The user phone number including the country code.
        $gId // The group JID.
    )
    {
        // TODO: Implement onGroupsChatEnd() method.
    }

    function onGroupsParticipantsAdd(
        $phone, // The user phone number including the country code.
        $groupId, // The group JID.
        $participant // The participant JID.
    )
    {
        // TODO: Implement onGroupsParticipantsAdd() method.
    }

    function onGroupsParticipantsRemove(
        $phone, // The user phone number including the country code.
        $groupId, // The group JID.
        $participant, // The participant JID.
        $author // The author JID.
    )
    {
        // TODO: Implement onGroupsParticipantsRemove() method.
    }

    function onLogin(
        $phone // The user phone number including the country code.
    )
    {
        // TODO: Implement onLogin() method.
    }

    function onLoginFailed(
        $phone, // The user phone number including the country code.
        $tag
    ) {
        // TODO: Implement onLoginFailed() method.
    }

    function onMediaMessageSent(
        $phone, // The user phone number including the country code.
        $to,
        $id,
        $filetype,
        $url,
        $filename,
        $filesize,
        $filehash,
        $icon
    ) {
        // TODO: Implement onMediaMessageSent() method.
    }

    function onMediaUploadFailed(
        $phone, // The user phone number including the country code.
        $id,
        $node,
        $messageNode,
        $reason
    ) {
        // TODO: Implement onMediaUploadFailed() method.
    }

    function onMessageComposing(
        $phone, // The user phone number including the country code.
        $from, // The sender JID.
        $msgid, // The message id.
        $type, // The message type.
        $time // The unix time when send message notification.
    )
    {
        // TODO: Implement onMessageComposing() method.
    }

    function onMessagePaused(
        $phone, // The user phone number including the country code.
        $from, // The sender JID.
        $msgid, // The message id.
        $type, // The message type.
        $time // The unix time when send message notification.
    )
    {
        // TODO: Implement onMessagePaused() method.
    }

    function onMessageReceivedClient(
        $phone, // The user phone number including the country code.
        $from, // The sender JID.
        $msgid, // The message id.
        $type, // The message type.
        $time // The unix time when send message notification.
    )
    {
        // TODO: Implement onMessageReceivedClient() method.
    }

    function onMessageReceivedServer(
        $phone, // The user phone number including the country code.
        $from, // The sender JID.
        $msgid, // The message id.
        $type // The message type.
    )
    {
        // TODO: Implement onMessageReceivedServer() method.
    }

    function onPing(
        $phone, // The user phone number including the country code.
        $msgid // The message id.
    )
    {
        // TODO: Implement onPing() method.
    }

    function onPresence(
        $phone, // The user phone number including the country code.
        $from, // The sender JID.
        $type // The presence type.
    )
    {
        // TODO: Implement onPresence() method.
    }

    function onProfilePictureChanged(
        $phone,
        $from,
        $id,
        $t
    ) {
        // TODO: Implement onProfilePictureChanged() method.
    }

    function onProfilePictureDeleted(
        $phone,
        $from,
        $id,
        $t
    ) {
        // TODO: Implement onProfilePictureDeleted() method.
    }

    function onSendMessage(
        $phone, // The user phone number including the country code.
        $targets,
        $id,
        $node
    ) {
        // TODO: Implement onSendMessage() method.
    }

    function onSendMessageReceived(
        $phone, // The user phone number including the country code.
        $id, // Message ID
        $from, // The sender JID.
        $type // Message type
    )
    {
        // TODO: Implement onSendMessageReceived() method.
    }

    function onSendPong(
        $phone, // The user phone number including the country code.
        $msgid // The message id.
    )
    {
        // TODO: Implement onSendPong() method.
    }

    function onSendPresence(
        $phone, // The user phone number including the country code.
        $type, // Presence type.
        $name // User nickname.
    )
    {
        // TODO: Implement onSendPresence() method.
    }

    function onSendStatusUpdate(
        $phone, // The user phone number including the country code.
        $msg // The status message.
    )
    {
        // TODO: Implement onSendStatusUpdate() method.
    }

    function onUploadFile(
        $phone, // The user phone number including the country code.
        $name, // The filename.
        $url // The remote url on WhatsApp servers (note, // this is NOT the URL to download the file, only used for sending message).
    )
    {
        // TODO: Implement onUploadFile() method.
    }

    function onUploadFileFailed(
        $phone, // The user phone number including the country code.
        $name // The filename.
    )
    {
        // TODO: Implement onUploadFileFailed() method.
    }

    /**
     * @param $result SyncResult
     * @return mixed
     */
    function onGetSyncResult(
        $result
    ) {
        // TODO: Implement onGetSyncResult() method.
    }

    function onGetReceipt(
        $from,
        $id,
        $offline,
        $retry
    ) {
        // TODO: Implement onGetReceipt() method.
    }
}