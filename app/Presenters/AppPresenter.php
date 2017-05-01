<?php namespace App\Presenters;

class AppPresenter
{
    /**
     * 替换资源域名
     *
     * @param string $asset
     * @param string $domain
     * @return mixed|string
     */
    public static function getAssetPath($asset = '', $domain = '')
    {
        $domain = str_replace('.', '', $domain);
        $host = request()->getHost();
        if (!empty($domain)) {
            if (str_contains($host, 'm.')) {
                return str_replace('m.', 'm.'.$domain.'.', $asset);

            } elseif (str_contains($host, 'www.')) {
                return str_replace('www.', $domain.'.', $asset);

            }
        } else{
            return $asset;
        }
    }

    /**
     * 显示上一章
     *
     * @param array $novelInfo
     * @param array $preChapt
     * @return string
     */
    public static function showPreChapt(array $novelInfo, array $preChapt)
    {
        if (empty($novelInfo)) {
            return '';
        }

        if (empty($preChapt)) {
            return '<a href="'.$novelInfo['link'].'">上一章</a>';
        }

        return '<a href="'.$novelInfo['link'].$preChapt['num'].'.html">上一章</a>';
    }

    /**
     * 显示下一章
     *
     * @param array $novelInfo
     * @param array $preChapt
     * @return string
     */
    public static function showNextChapt(array $novelInfo, array $nextChapt)
    {
        if (empty($novelInfo)) {
            return '';
        }

        if (empty($nextChapt)) {
            return '<a href="'.$novelInfo['link'].'">下一章</a>';
        }

        return '<a href="'.$novelInfo['link'].$nextChapt['num'].'.html">下一章</a>';
    }
}