namespace App\Http\Controllers;

use App\Models\AlternatifModel;
use App\Models\KriteriadanBobotModel;

class ValueController extends Controller
{
    public function index()
    {
        try {
            // Retrieve data from the NormalizationController
            $normalizationController = new NormalizationController();
            $optimizedResults = $normalizationController->optimizedMoora();

            // Compute final values (both cost and benefit)
            $finalValues = $this->computeFinalValues($optimizedResults);

            // Display the values
            return view('value.index', compact('finalValues'))->with('i', 0);
        } catch (\Exception $e) {
            // Handle exception
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    private function computeFinalValues($optimizedResults)
    {
        $finalValues = [
            'benefit' => [],
            'cost' => [],
        ];

        // Iterate through each alternatif
        foreach ($optimizedResults as $alternatifId => $optimizationData) {
            // Initialize the total for each type
            $finalValueB = 0;
            $finalValueC = 0;

            foreach ($optimizationData as $kriteriaId => $optimizationValue) {
                if ($kriteriaId !== 'totalOptimization') {
                    // Determine the type (benefit or cost)
                    $tipeKriteria = $kriteriabobot->where('id', $kriteriaId)->first()->tipe;

                    // For benefit criteria, add the optimization value directly
                    // For cost criteria, subtract the optimization value directly
                    if ($tipeKriteria == 'benefit') {
                        $finalValueB += $optimizationValue;
                    } elseif ($tipeKriteria == 'cost') {
                        $finalValueC += $optimizationValue;
                    }
                }
            }

            // Save the final values for the current alternatif
            $finalValues['benefit'][$alternatifId] = number_format($finalValueB, 2);
            $finalValues['cost'][$alternatifId] = number_format($finalValueC, 2);
        }

        return $finalValues;
    }
    
}
