<?php

namespace Joli\Jane\Swagger\Normalizer;

use Joli\Jane\Reference\Reference;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;

class ContactNormalizer implements DenormalizerInterface
{
    public $normalizerChain;
    public function setNormalizerChain(NormalizerChain $normalizerChain)
    {
        $this->normalizerChain = $normalizerChain;
    }
    public function supportsDenormalization($data, $type, $format = null)
    {
        if ($type !== 'Joli\\Jane\\Swagger\\Model\\Contact') {
            return false;
        }
        if ($format !== 'json') {
            return false;
        }

        return true;
    }
    public function denormalize($data, $class, $format = null, array $context = array())
    {
        if (empty($data)) {
            return null;
        }
        if (isset($data->{'$ref'})) {
            return new Reference($data->{'$ref'}, $context['rootSchema'] ?: null);
        }
        $object = new \Joli\Jane\Swagger\Model\Contact();
        if (!isset($context['rootSchema'])) {
            $context['rootSchema'] = $object;
        }
        if (isset($data->{'name'})) {
            $object->setName($data->{'name'});
        }
        if (isset($data->{'url'})) {
            $object->setUrl($data->{'url'});
        }
        if (isset($data->{'email'})) {
            $object->setEmail($data->{'email'});
        }

        return $object;
    }
}