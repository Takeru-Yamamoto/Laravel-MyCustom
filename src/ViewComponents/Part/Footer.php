<?php

namespace MyCustom\ViewComponents\Part;

use MyCustom\ViewComponents\Part\Base\BasePartViewComponent;

class Footer extends BasePartViewComponent
{
    /* property function footer */
    final public function isViewFooter(): bool
    {
        return config("mycustom.page_footer");
    }

    final public function hasFooterSection(): bool
    {
        return $this->hasSection("footer");
    }

    final public function footerText(): string
    {
        $firstPublicationYear = config("mycustom.first_publication_year");
        $copyrightHolderName  = config("mycustom.copyright_holder_name");
        $year = date("Y");

        $footerText = "© " . $firstPublicationYear;
        if ($year !== $firstPublicationYear) $footerText .=  "-" . $year;
        $footerText .=  " " . $copyrightHolderName;

        return $footerText;
    }
}
