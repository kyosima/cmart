<?php

namespace CKSource\CKFinder\Plugin\ImageWatermark;

use CKSource\CKFinder\CKFinder;
use CKSource\CKFinder\Image;
use CKSource\CKFinder\Event\CKFinderEvent;
use CKSource\CKFinder\Event\FileUploadEvent;
use CKSource\CKFinder\Plugin\PluginInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class ImageWatermark implements PluginInterface, EventSubscriberInterface
{
    protected $app;

    public function setContainer(CKFinder $app)
    {
        $this->app = $app;
    }

    public function getDefaultConfig()
    {
        return [
            'imagePath' => __DIR__ . '/logo.png',
            'position' => [
                'right'  => null,
                'bottom' => null,
                'left'   => null,
                'top'    => null
            ]
        ];
    }

    /**
     * Calculates the position of the watermark image.
     *
     * @param int $uploadedImageWidth
     * @param int $uploadedImageHeight
     * @param int $watermarkImageWidth
     * @param int $watermarkImageHeight
     *
     * @return array Calculated image position [X, Y]
     */
    public function calculatePosition($uploadedImageWidth, $uploadedImageHeight, $watermarkImageWidth, $watermarkImageHeight)
    {
        $dstX = $dstY = 0;

        $position = $this->app['config']->get('ImageWatermark.position');

        var_dump('aaaa', $position);

        if (isset($position['right'])) {
            $positionRight = $position['right'];

            if ($positionRight === 'center') {
                $dstX = $uploadedImageWidth / 2 - $watermarkImageWidth / 2;
            } else {
                $dstX = $uploadedImageWidth - $watermarkImageWidth - (int) $positionRight;
            }
        } elseif (isset($position['left'])) {
            $positionLeft = $position['left'];

            if ($positionLeft === 'center') {
                $dstX = $uploadedImageWidth / 2 - $watermarkImageWidth / 2;
            } else {
                $dstX = (int) $positionLeft;
            }
        }

        if (isset($position['top'])) {
            $positionTop = $position['top'];

            if ($positionTop === 'center') {
                $dstY = $uploadedImageHeight / 2 - $watermarkImageHeight / 2;
            } else {
                $dstY = (int) $positionTop;
            }
        } elseif (isset($position['bottom'])) {
            $positionBottom = $position['bottom'];

            if ($positionBottom === 'center') {
                $dstY = $uploadedImageHeight / 2 - $watermarkImageHeight / 2;
            } else {
                $dstY = $uploadedImageHeight - $watermarkImageHeight - (int) $positionBottom;
            }
        }

        return [$dstX, $dstY];
    }

    /**
     * Event listener method adding the watermark to uploaded image.
     *
     * @param FileUploadEvent $event
     */
    public function addWatermark(FileUploadEvent $event)
    {
        $uploadedFile = $event->getFile();

        if (Image::isSupportedExtension($uploadedFile->getExtension()) && $uploadedFile->isValidImage()) {
            $uploadedImage = Image::create($uploadedFile->getContents());
            $uploadedImageGD = $uploadedImage->getGDImage();

            $watermarkImagePath = $this->app['config']->get('ImageWatermark.imagePath');

            if (Image::isSupportedExtension(pathinfo($watermarkImagePath, PATHINFO_EXTENSION))) {
                var_dump(pathinfo($watermarkImagePath, PATHINFO_EXTENSION)); // RUN

                $watermarkImage = Image::create(file_get_contents($watermarkImagePath));
                var_dump('avcxvc'); // NOT SHOWING
                $watermarkImageGD = $watermarkImage->getGDImage();

                // calculatePosition() does not return anything
                list($dstX, $dstY) = $this->calculatePosition($uploadedImage->getWidth(), $uploadedImage->getHeight(), $watermarkImage->getWidth(), $watermarkImage->getHeight());

                imagecopy($uploadedImageGD, $watermarkImageGD, $dstX, $dstY, 0, 0, $watermarkImage->getWidth(), $watermarkImage->getHeight());

                $uploadedFile->save($uploadedImage->getData());

                unset($watermarkImage);
            }

            unset($uploadedImage);
        }
    }

    /**
     * Returns an array of event names this subscriber wants to listen to.
     *
     * The array keys are event names and the value can be:
     *
     *  * The method name to call (priority defaults to 0).
     *  * An array composed of the method name to call and the priority.
     *  * An array of arrays composed of the method names to call and respective
     *    priorities, or 0 if unset.
     *
     * For instance:
     *
     *  * array('eventName' => 'methodName')
     *  * array('eventName' => array('methodName', $priority))
     *  * array('eventName' => array(array('methodName1', $priority), array('methodName2'))
     *
     * @return array The event names to listen to
     */
    public static function getSubscribedEvents()
    {
        return [
            CKFinderEvent::FILE_UPLOAD => 'addWatermark'
        ];
    }
}
