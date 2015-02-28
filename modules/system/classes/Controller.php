<?php namespace System\Classes;

use Controller as BaseController;
use System\Classes\ApplicationException;
use System\Classes\CombineAssets;
use Exception;

/**
 * The System controller class.
 *
 * @package october\system
 * @author Alexey Bobkov, Samuel Georges
 */
class Controller extends BaseController
{
    /**
     * Combines JavaScript and StyleSheet assets.
     * @param string $name Combined file code
     * @return string Combined content.
     */
    public function combine($name)
    {
        try {

            if (!strpos($name, '-')) {
                throw new ApplicationException(Lang::get('system::lang.combiner.not_found', ['name' => $name]));
            }

            $parts = explode('-', $name);
            $cacheId = $parts[0];

            $combiner = CombineAssets::instance();
            return $combiner->getContents($cacheId);

        }
        catch (Exception $ex) {
            return '/* '.$ex->getMessage().' */';
        }
    }
}
