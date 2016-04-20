<?php

Namespace App\Modules\Helpers;



use App\Modules\Models\Op;
use Illuminate\Contracts\View\View;
use Mockery\CountValidator\Exception;
use Vsmoraes\Pdf\Pdf;

/**
 * Class Helper
 * @package App\Modules\Helpers
 */
class Helper
{
    /**  */
	const LENGTH = 10;
	/**
	 * Arquivos temporários PDF
	 * @const TMP_PDF_FILES
	 */
	const TMP_PDF_FILES = '/files/tmp/pdf/';

    public static  $instance;

    private function  __construct(){}

    public static  function  getInstance()
    {
        $class = __CLASS__;
        if(!self::$instance instanceof $class)
            self::$instance = new $class();

        return self::$instance;
    }

    /**
     * Método para formatar data
     * @param \DateTime $dateTime
     * @param $format
     * @return string
     */
    public  static  function formatDate($dateTime, $format = 'd/m/Y')
    {
        if(!$dateTime instanceof \DateTime)
        {
            $dateTime = str_replace('/', '-', $dateTime);
            $dateTime = new \DateTime($dateTime);
        }
        return $dateTime->format($format);
    }

    /**
     * Método para encutar a chave de acesso da API e Password
     * @param $text
     * @param int $amount
     * @return string
     */
    public  static  function shortenString($text, $amount = Helper::LENGTH)
    {
        if (strlen($text)> $amount) {

            return "<span title='{$text}'>" . substr($text, 0, $amount) . "...</span>";
        }else{
            return $text;
        }
    }

    /**
     * @param $initials
     * @return float
     */
    public static function getRateFromAirport($initials)
    {
        return \App\Modules\Models\Rate::whereAirport($initials);
    }

	/**
	 * Formata uma string removendo caraceteres especiais,
	 * retornando a string minuscula formatada para um slug
	 *
	 * @param $str
	 * @return string
	 */
	public static function stringFormat($str)
	{
		$str = preg_replace('/[áàãâä]/ui', 'a', $str);
		$str = preg_replace('/[éèêë]/ui', 'e', $str);
		$str = preg_replace('/[íìîï]/ui', 'i', $str);
		$str = preg_replace('/[óòõôö]/ui', 'o', $str);
		$str = preg_replace('/[úùûü]/ui', 'u', $str);
		$str = preg_replace('/[ç]/ui', 'c', $str);
		// $str = preg_replace('/[,(),;:|!"#$%&/=?~^><ªº-]/', '_', $str);
		$str = preg_replace('/[^a-z0-9]/i', '_', $str);
		$str = preg_replace('/_+/', '_', $str);

		return strtolower($str);

	}

	public static function getContentByMimeType($filename) {

		$mime_types = array(
			'image/png' => '.png',
			'image/jpeg' => 'jpeg',
			'image/jpg' => 'jpg',
			'image/gif' => 'gif',
			'image/bmp' => 'bmp'
		);

		if(!isset($mime_types[$filename]))
			throw new \Exception('Índice inexistente');

		return $mime_types[$filename];

	}

	/**
	 * Envia e-mail
	 * @param $data
	 * @param $blade
	 *
	 * @return bool
	 */
	public static function sendMail($data, $blade)
	{
		try
		{
			\Mail::send($blade, ['data' => $data], function($mailer) use ($data)
			{
                $test = $data;
				$email      = (isset($data['user']->email)) ? $data['user']->email : $data['user']->first()->email;
				$fullname   = (isset($data['user']->fullname)) ? $data['user']->fullname : $data['user']->first()->fullname;

				//$mailer->from('emissao@buscaaereo.com.br', 'EloMilhas - Busca Aéreo');
				$mailer->to($email, $fullname)
				      ->subject('Cotação Busca Aéreo (' . date('d/m/Y H:i:s') . ')');

						if(isset($data['attach']))
						{
							$mailer->attach($data['attach']);
						}

			});

			/**
			 * Implementar
			 * Criar class de exception para o Mail
			 * Errors
			 */
			if(count(\Mail::failures()) > 0)
				dd(\Mail::failures());
			else
				return true;
		}
		catch(\Exception $e)
		{
			dd($e);
		}
	}

	/**
	 * @param $view
	 * @param bool|true $download
	 * @return array
	 */
	public static function toPDF($view, $download = true, Pdf $pdf)
	{
		try
		{
			/** @var string $path */
			$path =  public_path() . self::TMP_PDF_FILES;

			/** Se o diretório não existe */
			if(!is_dir($path))
				mkdir($path, 0775, true);

			/** @var string $file */
			$file = public_path() . self::TMP_PDF_FILES . md5('pdf' . rand(11111, 9999999) . time()) . '.pdf';

			/** Se o download existir */
			if($download)
			{
				$PDF = $pdf->load($view->render());
				return $PDF->download();
			}

			/** @var Pdf $PDF */
			$PDF = $pdf->load($view->render());
			$PDF->filename($file)
				->output();

			/** Se o diretório existe */
			if(is_file($file))
			{
				return $file;
			}
			else
			{
				throw new Exception('Arquivo não foi salvo!');
			}
		}
		catch(\Exception $e)
		{
			dd($e);
		}
	}

    /**
     * @param $status
     * @return string
     */
    public static function getOp($status)
    {

        switch($status):

            case Op::ATIVA:
                return "Ativa";

            case Op::CANCELADA:
                return "Cancelada";

            case Op::AGUARDANDO_PAGAMENTO:
                return "Aguardando pagamento";

            case Op::ANALISE:
                return "Em análise";

            case Op::FATURADA:
                return "Faturada";

        endswitch;
    }

}