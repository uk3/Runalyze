<?php
/**
 * This file contains class::AbstractExporter
 * @package Runalyze\Export\File
 */

namespace Runalyze\Export\File;

use Runalyze\Export\AbstractExporter;
use Runalyze\Util\LocalTime;

/**
 * Create exporter for given type
 *
 * @author Hannes Christiansen
 * @package Runalyze\Export\File
 */
abstract class AbstractFileExporter extends AbstractExporter
{
    /** @var string */
    const URL = 'activity/{id}/export/file/{enum}';

    /**
     * File content to write
     * @var string
     */
    protected $FileContent = '';

    /**
     * Get extension
     * @return string
     */
    abstract public function extension();

    /**
     * Export
     */
    abstract protected function createFile();

    /**
     * @return int
     */
    abstract public function enum();

    /**
     * @return string
     */
    public function iconClass()
    {
        return 'fa-file-text-o';
    }

    /**
     * @return string
     */
    public function url()
    {
        return str_replace(
            ['{id}', '{enum}'],
            [$this->Context->activity()->id(), $this->enum()],
            self::URL
        );
    }

    /**
     * Add indents to file content
     */
    final protected function formatFileContentAsXML()
    {
        $XML = new \DOMDocument('1.0');
        $XML->preserveWhiteSpace = false;
        $XML->loadXML( $this->FileContent );
        $XML->formatOutput = true;

        $this->FileContent = $XML->saveXML();
    }

    /**
     * Get file content
     * @return string
     */
    final public function fileContent()
    {
        return $this->FileContent;
    }

	/**
	 * Create file but don't start download
	 */
	final public function createFileWithoutDirectDownload()
	{
		$this->createFile();
	}

    /**
     * Download content
     */
    final public function downloadFile()
    {
        header("Content-Type: ".$this->mimeType());
        header("Content-Disposition: attachment; filename=".$this->filename()."");

        $this->createFile();

        print $this->FileContent;
    }

    /**
     * @return string
     *
     * @see https://svn.apache.org/repos/asf/httpd/httpd/trunk/docs/conf/mime.types
     */
    abstract protected function mimeType();

    /**
     * Get filename
     * @return string
     */
    final public function filename()
    {
        if (is_null($this->Context)) {
            return 'undefined.'.$this->extension();
        }

        return self::fileNameStart().LocalTime::date('Y-m-d_H-i', $this->Context->activity()->timestamp()).'_'.$this->Context->activity()->id().'.'.$this->extension();
    }

    /**
     * Get file name start
     * @return string
     */
    public static function fileNameStart()
    {
        return \SessionAccountHandler::getId().'-Activity_';
    }
}
