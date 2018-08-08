<?php

namespace lo\modules\email\components\sparkpost;

use yii\base\NotSupportedException;
use yii\helpers\ArrayHelper;
use yii\mail\BaseMessage;

/**
 * Message is a representation of a message that will be consumed by Mailer.
 * Templates are supported and, if used, will override specified content data with template's ones.
 *
 * @link   https://developers.sparkpost.com/api/transmissions API Reference
 * @see    Mailer
 * @author Ustmaestro <ustmaestro@gmail.com>
 */
class Message extends BaseMessage
{
    /**
     * Helper map for composing sparkpost transmission
     *
     * @var array
     */
    static private $transmissionAttributesMap = [
        // sparkpost -> internal
        'options' => '_options',              // array
        'campaign_id' => '_campaign_id',          // string
        'description' => '_description',          // string
        'metadata' => '_metadata',             // array
        'substitution_data' => '_substitution_data',    // array
        'return_path' => '_return_path',          // string
        'content' => '_content',              // array
        'recipients' => '_recipients',           // array
    ];

    /**
     * Helper map for composing message options
     *
     * @var array
     */
    static private $optionsAttributesMap = [
        'start_time',           // string
        'open_tracking',        // boolean
        'click_tracking',       // boolean
        'transactional',        // boolean
        'sandbox',              // boolean
        'skip_suppression',     // boolean
        'ip_pool',              // string
        'inline_css',           // boolean
    ];

    /**
     * Helper map for composing message content
     *
     * @var array
     */
    static private $contentAttributesMap = [
        'html',                     // string
        'text',                     // string
        'push',                     // array
        'subject',                  // string
        'from',                     // string|array
        'reply_to',                 // string
        'headers',                  // array
        'attachments',              // array
        'inline_images',            // array

        'template_id',              // string
        'use_draft_template',       // string
    ];

    private $_options = [];
    private $_campaign_id;
    private $_description;
    private $_metadata = [];
    private $_substitution_data = [];
    private $_substitution_data_keys = [];
    private $_return_path;
    private $_content = [];
    private $_recipients = [];
    private $_recipients_list = [];

    /* transmission attributes setters/getters */
    public function setOptions($options)
    {
        foreach (self::$optionsAttributesMap as $key) {
            if (\in_array($key, $options, true)) {
                $this->_options[$key] = $options[$key];
            }
        }

        return $this;
    }

    public function getOptions(): array
    {
        return $this->_options;
    }

    public function setCampaignId($campaign_id)
    {
        $this->_campaign_id = $campaign_id;

        return $this;
    }

    public function getCampaignId()
    {
        return $this->_campaign_id;
    }

    public function setDescription($description)
    {
        $this->_description = $description;

        return $this;
    }

    public function getDescription()
    {
        return $this->_description;
    }

    public function setMetadata($metadata)
    {
        $this->_metadata = $metadata;

        return $this;
    }

    public function getMetadata(): array
    {
        return $this->_metadata;
    }

    public function setSubstitutionData($substitution_data)
    {
        $this->_substitution_data = $substitution_data;

        return $this;
    }

    public function getSubstitutionData(): array
    {
        return $this->_substitution_data;
    }

    public function setSubstitutionDataKeys($data)
    {
        $this->_substitution_data_keys = $data;

        return $this;
    }

    /**
     * @param $data
     * @return array
     */
    public function getSubstitutionDataByKey($data): array
    {
        $item = [];
        foreach ($this->_substitution_data_keys as $key) {
            if (isset($data[$key])) {
                $item[$key] = $data[$key];
            }
        }

        return $item;
    }

    public function setReturnPath($return_path)
    {
        $this->_return_path = $return_path;

        return $this;
    }

    public function getReturnPath()
    {
        return $this->_return_path;
    }

    /**
     * @param $content
     * @return $this
     */
    public function setContent($content): self
    {
        foreach (self::$contentAttributesMap as $key) {
            if (\in_array($key, $content, true)) {
                $this->_content[$key] = $content[$key];
            }
        }

        return $this;
    }

    /**
     * @return array
     */
    public function getContent(): array
    {
        return $this->_content;
    }

    public function setRecipients($recipients)
    {
        $this->_recipients = $this->normalizeRecipientsEmails($recipients);

        return $this;
    }

    public function getRecipients(): array
    {
        return $this->_recipients;
    }

    public function setRecipientsList($recipients_list)
    {
        $this->_recipients_list = $recipients_list;

        return $this;
    }

    public function getRecipientsList(): array
    {
        return $this->_recipients_list;
    }

    /**
     * @param array|string $to
     * @return $this
     */
    public function setTo($to): self
    {
        if (\is_string($to)) {
            $to = $to ? [$to] : [];
        }
        $this->_recipients = $this->normalizeRecipientsEmails($to);

        return $this;
    }

    public function getTo()
    {
        return $this->_recipients;
    }

    /* content attributes setters/getters  */
    public function setHtmlBody($html)
    {
        $this->_content['html'] = $html;

        return $this;
    }

    public function getHtmlBody()
    {
        return $this->_content['html'] ?? null;
    }

    public function setTextBody($text)
    {
        $this->_content['text'] = $text;

        return $this;
    }

    public function getTextBody()
    {
        return $this->_content['text'] ?? null;
    }

    public function setRfc822Body($rfc822)
    {
        $this->_content['rfc822'] = $rfc822;

        return $this;
    }

    public function getRfc822Body()
    {
        return $this->_content['rfc822'] ?? null;
    }

    public function setPush($push)
    {
        $this->_content['push'] = $push;

        return $this;
    }

    public function getPush()
    {
        return $this->_content['push'] ?? null;
    }

    public function setSubject($subject)
    {
        $this->_content['subject'] = $subject;

        return $this;
    }

    public function getSubject()
    {
        return $this->_content['subject'] ?? null;
    }

    public function setFrom($from)
    {
        $this->_content['from'] = $this->normalizeFromEmail($from);

        return $this;
    }

    public function getFrom()
    {
        return $this->_content['from'] ?? null;
    }

    public function setReplyTo($replyTo)
    {
        $this->_content['reply_to'] = $replyTo;

        return $this;
    }

    public function getReplyTo()
    {
        return $this->_content['reply_to'] ?? null;
    }

    public function setHeaders($headers)
    {
        $this->_content['headers'] = $headers;

        return $this;
    }

    public function getHeaders()
    {
        return $this->_content['headers'] ?? null;
    }

    public function setAttachments($attachments)
    {
        $this->_content['attachments'] = $attachments;

        return $this;
    }

    public function getAttachments()
    {
        return $this->_content['attachments'] ?? null;
    }

    public function setInlineImages($inline_images)
    {
        $this->_content['inline_images'] = $inline_images;

        return $this;
    }

    public function getInlineImages()
    {
        return $this->_content['inline_images'] ?? null;
    }

    public function setTemplateId($template_id)
    {
        $this->_content['template_id'] = $template_id;

        return $this;
    }

    public function getTemplateId()
    {
        return $this->_content['template_id'] ?? null;
    }

    public function setUseDraftTemplate($use_draft_template)
    {
        $this->_content['use_draft_template'] = $use_draft_template;

        return $this;
    }

    public function getUseDraftTemplate()
    {
        return $this->_content['use_draft_template'] ?? null;
    }

    /* options attributes setters/getters  */
    public function setStartTime($start_time)
    {
        $this->_options['start_time'] = $start_time;

        return $this;
    }

    public function getStartTime()
    {
        return $this->_options['start_time'];
    }

    public function setOpenTracking($open_tracking)
    {
        $this->_options['open_tracking'] = $open_tracking;

        return $this;
    }

    public function getOpenTracking()
    {
        return $this->_options['open_tracking'];
    }

    public function setClickTracking($click_tracking)
    {
        $this->_options['click_tracking'] = $click_tracking;

        return $this;
    }

    public function getClickTracking()
    {
        return $this->_options['click_tracking'];
    }

    public function setTransactional($transactional)
    {
        $this->_options['transactional'] = $transactional;

        return $this;
    }

    public function getTransactional()
    {
        return $this->_options['transactional'];
    }

    public function setSandbox($sandbox)
    {
        $this->_options['sandbox'] = $sandbox;

        return $this;
    }

    public function getSandbox()
    {
        return $this->_options['sandbox'];
    }

    public function setSkipSuppression($skip_suppression)
    {
        $this->_options['skip_suppression'] = $skip_suppression;

        return $this;
    }

    public function getSkipSuppression()
    {
        return $this->_options['skip_suppression'];
    }

    public function setIpPool($ip_pool)
    {
        $this->_options['ip_pool'] = $ip_pool;

        return $this;
    }

    public function getIpPool()
    {
        return $this->_options['ip_pool'];
    }

    public function setInlineCss($inline_css)
    {
        $this->_options['inline_css'] = $inline_css;

        return $this;
    }

    public function getInlineCss()
    {
        return $this->_options['inline_css'];
    }

    /**
     * Get sparkpost transmission data
     *
     * @return array
     */
    public function getTransmissionData(): array
    {
        $transmission = [];
        foreach (self::$transmissionAttributesMap as $key => $val) {
            if ($this->{$val}) {
                $transmission[$key] = $this->{$val};
            }
        }

        return $transmission;
    }

    /**
     * Normalize emails array for recipients
     *
     * @param array $emails
     * @return array
     */
    private function normalizeRecipientsEmails($emails): array
    {
        $addresses = [];
        foreach ($emails as $key => $data) {
            if (\is_int($key)) {
                if (\is_array($data)) {
                    $addresses[] = [
                        'address' => ['email' => $data['email']],
                        'substitution_data' => $this->getSubstitutionDataByKey($data),
                    ];
                } else {
                    $addresses[] = [
                        'address' => ['email' => $data],
                    ];
                }
            } else {
                $addresses[] = [
                    'address' => ['email' => $key, 'name' => $data],
                ];
            }
        }

        return $addresses;
    }

    /**
     * Normalize from email
     *
     * @param array|string $email
     * @return string
     */
    private function normalizeFromEmail($email): ?string
    {
        if (\is_string($email)) {
            return $email;
        }

        if (\is_array($email)) {
            return $this->emailsToString($email);
        }

        return null;
    }

    /**
     * Converts emails array to the string: ['name' => 'email'] -> '"name" <email>'
     *
     * @param array $emails
     * @return string
     */
    private function emailsToString($emails): string
    {
        $addresses = [];
        foreach ($emails as $email => $name) {
            $name = trim($name);
            if (\is_int($email)) {
                $addresses[] = $name;
            } else {
                $email = trim($email);
                $addresses[] = "\"{$name}\" <{$email}>";
            }
        }

        return implode(',', $addresses);
    }

    /*** INTERFACE METHODS ***/

    /**
     * Returns the character set of this message.
     *
     * @return string the character set of this message.
     */
    public function getCharset()
    {
        return null;
    }

    /**
     * @param string $charset
     * @throws NotSupportedException
     */
    public function setCharset($charset)
    {
        throw new NotSupportedException('Charset is not supported by SparkPost.');
    }

    /**
     * Returns the Cc (additional copy receiver) addresses of this message.
     *
     * @return array the Cc (additional copy receiver) addresses of this message.
     */
    public function getCc(): array
    {
        return [];
    }

    /**
     * Sets the Cc (additional copy receiver) addresses of this message.
     *
     * @param string|array $cc copy receiver email address.
     *                         You may pass an array of addresses if multiple recipients should receive this message.
     *                         You may also specify receiver name in addition to email address using format:
     *                         `[email => name]`.
     * @return void self reference.
     */
    public function setCc($cc)
    {
        //@todo: implement setCc
    }

    /**
     * Returns the Bcc (hidden copy receiver) addresses of this message.
     *
     * @return array the Bcc (hidden copy receiver) addresses of this message.
     */
    public function getBcc(): array
    {
        return [];
    }

    /**
     * Sets the Bcc (hidden copy receiver) addresses of this message.
     *
     * @param string|array $bcc hidden copy receiver email address.
     *                          You may pass an array of addresses if multiple recipients should receive this message.
     *                          You may also specify receiver name in addition to email address using format:
     *                          `[email => name]`.
     * @return $this self reference.
     */
    public function setBcc($bcc)
    {
        //@todo: implement setBcc
    }

    /**
     * Attaches existing file to the email message.
     *
     * @param string $fileName full file name
     * @param array  $options  options for embed file. Valid options are:
     *
     * - fileName: name, which should be used to attach file.
     * - contentType: attached file MIME type.
     *
     * @return $this self reference.
     */
    public function attach($fileName, array $options = [])
    {
        //@todo: implement attach
    }

    /**
     * Attach specified content as file for the email message.
     *
     * @param string $content attachment file content.
     * @param array  $options options for embed file. Valid options are:
     *
     * - fileName: name, which should be used to attach file.
     * - contentType: attached file MIME type.
     *
     * @return $this self reference.
     */
    public function attachContent($content, array $options = [])
    {
        //@todo: implement attachContent
    }

    /**
     * Attach a file and return it's CID source.
     * This method should be used when embedding images or other data in a message.
     *
     * @param string $fileName file name.
     * @param array  $options  options for embed file. Valid options are:
     *
     * - fileName: name, which should be used to attach file.
     * - contentType: attached file MIME type.
     *
     * @return string attachment CID.
     */
    public function embed($fileName, array $options = [])
    {
        //@todo: implement embed
    }

    /**
     * Attach a content as file and return it's CID source.
     * This method should be used when embedding images or other data in a message.
     *
     * @param string $content attachment file content.
     * @param array  $options options for embed file. Valid options are:
     *
     * - fileName: name, which should be used to attach file.
     * - contentType: attached file MIME type.
     *
     * @return string attachment CID.
     */
    public function embedContent($content, array $options = [])
    {
        //@todo: implement embedContent
    }

    /**
     * Returns string representation of this message.
     *
     * @return string the string representation of this message.
     */
    public function toString(): string
    {
        $to = ArrayHelper::getValue($this->getTo(), 'address.email', []);
        $cc = ArrayHelper::getValue($this->getCc(), 'address.email', []);
        $bc = ArrayHelper::getValue($this->getBcc(), 'address.email', []);

        return $this->getSubject() . ' - Recipients:'
            . ' [TO] ' . implode('; ', $to)
            . ' [CC] ' . implode('; ', $cc)
            . ' [BCC] ' . implode('; ', $bc);
    }
}
