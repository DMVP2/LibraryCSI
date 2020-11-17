<?php
    include_once("../Business/Persistence/PenaltyDAO.php");
    include_once("../Business/Entities/Penalty.php");
    include_once("../Business/Persistence/Connection.php");

class PenaltyDriving{

	/**
		 * Representa la conexión para pasarla a los DAOS utilizados
		 *
		 * @var Object
		 */
		private static $conexion; 
		/**
		 * Crear una penalidad
		 *
		 * @param Penalty $pPenlaty
		 * @return bool
		 */
		public static function createPenlaty($pPenlaty){
			$penaltyDAO = PenaltyDAO::getPenaltyDAO(self::$conexion);
			$penalty = $penaltyDAO->create($pPenlaty);
			return $penalty;
		}
		/**
		 * Edita */

		/**
		 * Busca un estudiante por su codigo
		 *
		 */

		/**
		 * Cambia la conexión
		 *
		 * @param Object $conexion
		 * @return void
		 */
		public static function setconexion($conexion)
		{
			self::$conexion = $conexion;
		}
}