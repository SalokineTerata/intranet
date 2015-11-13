<?php

/*
 * Copyright (C) 2015 tp4300001
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

class HtmlListSelectTagName extends HtmlListSelect {

    /**
     * Retourne le code HTML pour présenter la liste en mode consultation
     */
    public function getHtmlViewedContent() {
        if ($this->getSelectedValue()) {
            $return = $this->getSelectedContent();
        } else {
            $return = self::LIST_NO_SELECTION_VALUE;
        }
        return $return;
    }

    public function getHtmlAddContent() {

        return;
    }

    public function getHtmlEditableContent() {

        $oneSelected = FALSE;
        if ($this->getArrayListContent()) {
            $return .= '<' . $this->getAttributes()->getTagName()
                    . parent::getAttributesGlobal()->getAllHtmlParametersWithSpaceBefore()
                    . parent::getEventsForm()->getAllHtmlParametersWithSpaceBefore()
                    . $this->getAttributes()->getAllHtmlParametersWithSpaceBefore()
                    . '/>'
            ;
            $Tagtmp = $this->getAttributes()->getAllHtmlParametersWithSpaceBefore();
            //Création du contenu de la liste
            foreach ($this->getArrayListContent() as $optionKey => $optionValue) {
                $option = new HtmlTagOption();
                $option->getAttributes()->getValue()->setValue($optionKey);
                $option->setDiplayValue($optionValue);

                if ($optionKey == $this->getSelectedValue()) {

                    $option->getAttributes()->getSelected()->setTrue();
                    $oneSelected = TRUE;
                } else {
                    $option->getAttributes()->getSelected()->setFalse();
                }

                $return .= '<'
                        . $option->getAttributes()->getTagName()
                        . $Tagtmp
                        . $option->getAttributes()->getAllHtmlParametersWithSpaceBefore() . '>'
                        . $option->getDiplayValueToHtml()
                        . '</' . $option->getAttributes()->getTagName() . '>';
            }
            if ($oneSelected == FALSE) {
                $option = new HtmlTagOption();
                $option->getAttributes()->getValue()->setValue(self::LIST_EMPTY_VALUE);
                $option->setDiplayValue(self::LIST_NO_VALID_SELECTION_MESSAGE);
                $option->getAttributes()->getSelected()->setTrue();
                $return .= '<'
                        . $option->getAttributes()->getTagName()
                        . $Tagtmp
                        . $option->getAttributes()->getAllHtmlParametersWithSpaceBefore() . '>'
                        . $option->getDiplayValueToHtml()
                        . '</' . $option->getAttributes()->getTagName() . '>';
            }
            $return .= '</' . $this->getAttributes()->getTagName() . '>';
//                    . parent::getAttributesGlobal()->getIconMenuToHtml();
        } else {
            $return .= '<i>' . Html::showValue(self::LIST_EMPTY_MESSAGE) . '</i>';
        }
        return $return;
    }

}
