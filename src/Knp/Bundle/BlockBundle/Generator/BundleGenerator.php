<?php

namespace Knp\Bundle\BlockBundle\Generator;

use Symfony\Component\HttpKernel\Util\Filesystem;
use Symfony\Component\DependencyInjection\Container;

/**
 * Generates a bundle.
 *
 */
class BundleGenerator extends Generator
{
    private $filesystem;
    private $skeletonDir;

    public function __construct(Filesystem $filesystem, $skeletonDir)
    {
        $this->filesystem = $filesystem;
        $this->skeletonDir = $skeletonDir;
    }

    public function generate($namespace, $bundle, $dir, $format = 'xml')
    {
        $dir .= '/'.strtr($namespace, '\\', '/');
        if (file_exists($dir)) {
            throw new \RuntimeException(sprintf('Unable to generate the bundle as the target directory "%s" is not empty.', realpath($dir)));
        }

        $basename = substr($bundle, 0, -6);
        $parameters = array(
            'namespace' => $namespace,
            'bundle'    => $bundle,
            'format'    => $format,
            'bundle_basename' => $basename,
            'extension_alias' => Container::underscore($basename),
        );

        $this->renderFile($this->skeletonDir, 'Bundle.php', $dir.'/'.$bundle.'.php', $parameters);
        $this->renderFile($this->skeletonDir, 'Extension.php', $dir.'/DependencyInjection/'.$basename.'Extension.php', $parameters);
        $this->renderFile($this->skeletonDir, 'Configuration.php', $dir.'/DependencyInjection/Configuration.php', $parameters);
        $this->renderFile($this->skeletonDir, 'DefaultController.php', $dir.'/Controller/'.$basename.'Controller.php', $parameters);

        $this->renderFile($this->skeletonDir, 'BlockType.php', $dir.'/'.$basename.'Type.php', $parameters);
        $this->renderFile($this->skeletonDir, 'BlockDocument.php', $dir.'/Document/'.$basename.'.php', $parameters);


        $this->renderFile($this->skeletonDir, 'edition.html.twig', $dir.'/Resources/views/BlockType/Form/'.$parameters['extension_alias'].'.html.twig', $parameters);
        $this->renderFile($this->skeletonDir, 'view.html.twig', $dir.'/Resources/views/BlockType/'.$parameters['extension_alias'].'.html.twig', $parameters);

        $this->renderFile($this->skeletonDir, 'controllers.xml', $dir.'/Resources/config/controllers.xml', $parameters);
        $this->renderFile($this->skeletonDir, 'forms.xml', $dir.'/Resources/config/forms.xml', $parameters);
        $this->renderFile($this->skeletonDir, 'block_types.xml', $dir.'/Resources/config/block_types.xml', $parameters);
    }
}
