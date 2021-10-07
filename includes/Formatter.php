<?php

namespace CF7_Webhook_Formatter;

use WPCF7_Submission;

class Formatter
{

    public function ctz_get_data_from_contact_form($data, $contact_form) {

        $submission = WPCF7_Submission::get_instance(); // @phpstan-ignore-line
        $data = $submission->get_posted_data();

        if (!is_array($data)) {
            return $data;
        }

        $data = $this->groupByFirstSeparator($data);
        return $this->separateTabsToArrays($data);
    }

    private function groupByFirstSeparator(array $data): array {

        $formattedData = [];
        foreach ($data as $key => $val) {
            preg_match('/(?P<group>[a-zA-Z0-9]+)-(?P<property>.*)/', $key, $matches);
            $formattedData[$matches['group']][$matches['property']] = $val;
        }

        return $formattedData;
    }

    private function separateTabsToArrays(array $data): array {

        // Assume data is already grouped by 'groupByFirstSeparator()'
        foreach ($data as $groupKey => $tab) {

            $formattedGroup = [];
            foreach($tab as $key => $tabVal) {

                // Skip non tab values
                if (!is_array($tabVal)) {
                    continue;
                }

                foreach ($tabVal as $tabIndex => $val) {

                    // Get Tab Index and add item to group
                    if (preg_match('/_tab-(?P<tab>[0-9]+)/', $tabIndex, $matches)) {
                        $formattedGroup[$matches['tab']][$key] = $val;
                    } else {
                        $formattedGroup[0][$key] = $val;
                    }

                }
            }

            // If group was reformatted overwrite original one
            if (!empty($formattedGroup)) {
                $data[$groupKey] = $formattedGroup;
            }

        }

        return $data;
    }

}