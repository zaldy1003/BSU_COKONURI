<?

require_once '../config/db.php';

class PengaturanTransaksi
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function getAll()
    {
        $query = "SELECT * FROM pengaturan_transaksi";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id)
    {
        $query = "SELECT * FROM pengaturan_transaksi WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($data)
    {
        $query = "INSERT INTO pengaturan_transaksi (jenisSampah, hargaPerKG) VALUES (:jenisSampah, :hargaPerKG)";
        $stmt = $this->db->prepare($query);
        return $stmt->execute($data);
    }

    public function update($data)
    {
        $query = "UPDATE pengaturan_transaksi SET jenisSampah = :jenisSampah, hargaPerKG = :hargaPerKG WHERE id = :id";
        $stmt = $this->db->prepare($query);
        return $stmt->execute($data);
    }

    public function delete($id)
    {
        $query = "DELETE FROM pengaturan_transaksi WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}
