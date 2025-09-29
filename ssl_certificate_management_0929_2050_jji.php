<?php
// 代码生成时间: 2025-09-29 20:50:14
class SslCertificateManager {

    /**
     * @var string $certificatePath The path where certificates are stored.
     */
    private $certificatePath;

    /**
     * Constructor for SslCertificateManager.
     *
     * @param string $certificatePath Path to the certificate directory.
     */
    public function __construct($certificatePath) {
        $this->certificatePath = $certificatePath;
    }

    /**
     * Generates a new SSL/TLS certificate.
     *
     * @param string $domainName The domain name for which the certificate is generated.
     * @return bool Returns true on success, false on failure.
     */
    public function generateCertificate($domainName) {
        try {
            // Use openssl to generate a new certificate
            $privateKey = openssl_pkey_new();
            $csrConfig = array(
                "digest_alg" => "sha256",
                "private_key_bits" => 2048,
                "private_key_type" => OPENSSL_KEYTYPE_RSA,
                "encrypt_key" => true,
            );

            $csr = openssl_csr_new($csrConfig, $privateKey);
            $csrInfo = openssl_csr_get_subject($csr);
            $csrInfo['CN'] = $domainName;
            openssl_csr_export($csr, $csrFile);
            openssl_csr_export($csr, $this->getCertificatePath() . '/csr/' . $domainName . '.csr');

            // Generate the certificate using the CSR
            $cert = openssl_csr_sign($csr, null, $privateKey, 365);
            openssl_x509_export($cert, $certOut);
            openssl_pkey_export($privateKey, $pkeyOut);

            // Save the certificate and private key to the certificate path
            file_put_contents($this->getCertificatePath() . '/certs/' . $domainName . '.crt', $certOut);
            file_put_contents($this->getCertificatePath() . '/private/' . $domainName . '.key', $pkeyOut);

            return true;
        } catch (Exception $e) {
            // Error handling
            error_log('Failed to generate certificate: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Retrieves the path to the certificate directory.
     *
     * @return string The path to the certificate directory.
     */
    private function getCertificatePath() {
        return $this->certificatePath;
    }

    /**
     * Lists all SSL/TLS certificates.
     *
     * @return array An array of certificate filenames.
     */
    public function listCertificates() {
        $certs = glob($this->getCertificatePath() . '/certs/*.crt');
        return array_map('basename', $certs);
    }

    /**
     * Deletes a specific SSL/TLS certificate.
     *
     * @param string $domainName The domain name of the certificate to delete.
     * @return bool Returns true on success, false on failure.
     */
    public function deleteCertificate($domainName) {
        try {
            // Delete the certificate and private key files
            if (file_exists($this->getCertificatePath() . '/certs/' . $domainName . '.crt')) {
                unlink($this->getCertificatePath() . '/certs/' . $domainName . '.crt');
            }
            if (file_exists($this->getCertificatePath() . '/private/' . $domainName . '.key')) {
                unlink($this->getCertificatePath() . '/private/' . $domainName . '.key');
            }
            return true;
        } catch (Exception $e) {
            // Error handling
            error_log('Failed to delete certificate: ' . $e->getMessage());
            return false;
        }
    }
}

// Example usage:
try {
    $certManager = new SslCertificateManager('/path/to/certificates');
    if ($certManager->generateCertificate('example.com')) {
        echo 'Certificate generated successfully.';
    } else {
        echo 'Failed to generate certificate.';
    }
} catch (Exception $e) {
    error_log('Error initializing certificate manager: ' . $e->getMessage());
}
